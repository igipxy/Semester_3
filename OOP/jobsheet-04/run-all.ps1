$ErrorActionPreference = 'Stop'

$root = $PSScriptRoot
$sourceDir = Join-Path $root 'src'
$buildDir = Join-Path $root '.build'
$outputDir = Join-Path $root 'docs\output'

if (Test-Path -LiteralPath $buildDir) {
    Remove-Item -LiteralPath $buildDir -Recurse -Force
}

New-Item -ItemType Directory -Force -Path $buildDir, $outputDir | Out-Null

$sources = Get-ChildItem -LiteralPath $sourceDir -Recurse -Filter '*.java' |
    Select-Object -ExpandProperty FullName

& javac -encoding UTF-8 -d $buildDir $sources
if ($LASTEXITCODE -ne 0) {
    throw 'Compilation failed.'
}

$programs = [ordered]@{
    'experiment-01' = 'id.ac.polinema.classrelation.experiment1.MainExperiment1'
    'experiment-02' = 'id.ac.polinema.classrelation.experiment2.MainExperiment2'
    'experiment-03' = 'id.ac.polinema.classrelation.experiment3.MainExperiment3'
    'experiment-03-no-assistant' = 'id.ac.polinema.classrelation.experiment3.MainQuestion'
    'experiment-04' = 'id.ac.polinema.classrelation.experiment4.MainExperiment4'
    'experiment-05' = 'id.ac.polinema.classrelation.experiment5.MainExperiment5'
    'experiment-06' = 'id.ac.polinema.classrelation.experiment6.MainExperiment6'
    'independent-assignment' = 'id.ac.polinema.classrelation.assignment.MainAssignment'
}

foreach ($entry in $programs.GetEnumerator()) {
    $result = & java -cp $buildDir $entry.Value
    if ($LASTEXITCODE -ne 0) {
        throw "Execution failed: $($entry.Value)"
    }

    $normalizedResult = ($result -join [Environment]::NewLine).TrimEnd()
    $normalizedResult | Set-Content -LiteralPath (Join-Path $outputDir "$($entry.Key).txt") -Encoding UTF8
    Write-Host "PASS $($entry.Key)"
}

Write-Host "All Java sources compiled and all $($programs.Count) programs ran successfully."
