# variable to hold the csv filename
#should be .ps1 not txt
$csvFilename = "excelToCsv.csv"

$csv = import-csv $csvFilename

#change to meet root node requirements
$xmlstring = "<root><files>"

$csv | foreach {
  $xmlstring += "<file><lanname>$($_.lanname)</lanname><sitecorename>$($_.sitecorename)</sitecorename></file>"
}

$xmlstring += "</files></root>"

$xmlFilename = "bob.xml"
$xmlstring > $xmlFilename


