<?

/**********************************************************************
**
** Example script that goes with the pdf_search class.
**
** License: Public Domain
** Warranty: None
**
** Author: Rene Kluwen / Chimit Software <rene.kluwen@chimit.nl>
**
***********************************************************************/

require("pdfsearch.php");

// The following determines the document to search in.
$theDocument = "MyDocument.pdf";

// The text to search for. Usually we get this as a result of a form
// submit.
$searchText = "marbles";

// First we read the document into memory space.
// Also, pdf documents can be read from a database or otherwise
// (which is what I did when writing the class).
$fp = fopen($theDocument, "r");
$content = fread($fp, filesize($theDocument));
fclose($fp);

// Allocate class instance
$pdf = new pdf_search($content);

// And do the search
if ($pdf->textfound($searchText)) {
    echo "We found $searchText.";
}
else {
    echo "$searchText was not found.";
}

?>