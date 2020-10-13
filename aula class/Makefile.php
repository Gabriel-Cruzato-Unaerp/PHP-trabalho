<?php

function createFile()
{
    $nomeArquivo = $_POST['arquivoInputname'];
    $conteudoTextArea = $_POST['textAreaName'];
    $codigo = $_POST['codigoInputname'];

    if (file_exists($codigo)) {
        echo '<script type="text/JavaScript">  
     alert("Arquivo criado/editado dentro de pasta já existente"); 
     </script>';
    } else {
        mkdir($codigo, 0777);
    }

    $myfile = fopen("$codigo\\$nomeArquivo.txt", "w+") or die("Unable to open file!");
    $txt = $conteudoTextArea;
    fwrite($myfile, $txt);
    fclose($myfile);
    if (file_exists("documenti/$myfile")) unlink("documenti/$myfile");
}

function listFiles()
{
    $d = dir(".");

    echo "<ul>";

    while (false !== ($entry = $d->read())) {
        if (is_dir($entry) && ($entry != '.') && ($entry != '..')) {
            echo "<li><a href='{$entry}'>{$entry}</a></li>";
        }
    }
    echo "</ul>";

    include 'buttons.html';
    $d->close();
}


createFile();
listFiles();
