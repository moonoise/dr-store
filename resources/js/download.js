$( document ).ready(function() {
    $('a[href$="pdf"]').addClass('download-link download-pdf');
    $('a[href$="doc"]').addClass('download-link download-doc');
    $('a[href$="docx"]').addClass('download-link download-docx');
    $('a[href$="xls"]').addClass('download-link download-xls');
    $('a[href$="xlsx"]').addClass('download-link download-xlsx');
  });
