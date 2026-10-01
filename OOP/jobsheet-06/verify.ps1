$ErrorActionPreference = 'Stop'

$root = $PSScriptRoot
$sourceDir = Join-Path $root 'src'
$documentsDir = [Environment]::GetFolderPath('MyDocuments')
$buildDir = Join-Path $documentsDir 'Codex\j6build'
$outputDir = Join-Path $root 'docs\output'

if (Test-Path -LiteralPath $buildDir) {
    Remove-Item -LiteralPath $buildDir -Recurse -Force
}

New-Item -ItemType Directory -Force -Path $buildDir, $outputDir | Out-Null

$sourceGroups = Get-ChildItem -LiteralPath $sourceDir -Recurse -Filter '*.java' |
    Group-Object DirectoryName

foreach ($group in $sourceGroups) {
    $packageSources = $group.Group | Select-Object -ExpandProperty FullName
    & javac -encoding UTF-8 -d $buildDir $packageSources
    if ($LASTEXITCODE -ne 0) {
        throw "Compilation failed for package folder: $($group.Name)"
    }
}

$programs = [ordered]@{
    'experiment-01' = 'id.ac.polinema.inheritance.experiment1.Percobaan1'
    'experiment-02' = 'id.ac.polinema.inheritance.experiment2.Percobaan2'
    'experiment-03' = 'id.ac.polinema.inheritance.experiment3.Percobaan3'
    'experiment-04' = 'id.ac.polinema.inheritance.experiment4.Percobaan4'
    'experiment-05' = 'id.ac.polinema.inheritance.experiment5.Inheritance1'
    'experiment-06' = 'id.ac.polinema.inheritance.experiment6.Inheritance1'
    'ticket-exercise' = 'id.ac.polinema.inheritance.exercise.TestTiket'
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
Remove-Item -LiteralPath $buildDir -Recurse -Force
