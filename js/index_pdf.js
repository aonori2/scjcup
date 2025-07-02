const pdfPath = "/img/report.pdf";

pdfjsLib.GlobalWorkerOptions.workerSrc = "/js/pdf.worker.js";

// 非同期でPDFファイルを読み込み
const loadingTask = pdfjsLib.getDocument(pdfPath);
(async () => {
  const pdf = await loadingTask.promise;

  // 最初のページを取得
  const page = await pdf.getPage(1);
  const scale = 1.0;
  const viewport = page.getViewport({ scale });
  
  // 高DPIをサポート
  const outputScale = window.devicePixelRatio || 1;

  // PDFのページ寸法を使用してキャンバスを準備
  const canvas = document.getElementById("pdf-canvas");
  const context = canvas.getContext("2d");

  canvas.width = Math.floor(viewport.width * outputScale);
  canvas.height = Math.floor(viewport.height * outputScale);
  canvas.style.width = Math.floor(viewport.width) + "px";
  canvas.style.height = Math.floor(viewport.height) + "px";

  const transform = outputScale !== 1 
    ? [outputScale, 0, 0, outputScale, 0, 0] 
    : null;

  // PDFのページをキャンバスにレンダリング
  const renderContext = {
    canvasContext: context,
    transform,
    viewport,
  };
  page.render(renderContext);
})();
