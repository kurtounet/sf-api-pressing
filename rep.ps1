# Fonction pour afficher l'arborescence d'un dossier
function Show-Tree {
    param (
        [string]$Path = ".",
        [int]$Level = 0
    )

    # Obtenir les éléments du dossier
    $items = Get-ChildItem -Path $Path

    # Afficher chaque élément
    foreach ($item in $items) {
        # Préfixe avec des espaces pour l'indentation
        $prefix = " " * ($Level * 4)
        Write-Output "$prefix$item"

        # Si l'élément est un dossier, appeler récursivement la fonction
        if ($item.PSIsContainer) {
            Show-Tree -Path $item.FullName -Level ($Level + 1)
        }
    }
}

# Appeler la fonction avec le chemin du dossier souhaité
<<<<<<< HEAD
Show-Tree -Path "C:\businesscase\sf-api-pressing\src" # pc HB
#Show-Tree -Path "F:\sf-api-pressing\src" # pc maison
=======
Show-Tree -Path "F:\sf-api-pressing\public"
>>>>>>> 2dc582a6b6e8c7b841835b7b5288f6ae15ee1c96
#Show-Tree -Path "G:\.Labo\Symfony\projetsymfony\templates"
