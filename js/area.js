
// zone de texte pour la recherche dans le header
areaSearch.addEventListener('click', function()
{
  efface("Recherche...",areaSearch);
});

// zone de texte lorsqu'on est dans le formulaire pour la zone de texte défintion
if (typeof(areaDefinition) != "undefined")
{
  areaDefinition.addEventListener('click', function()
  {
    efface('Définition', areaDefinition);
  })
}

// zone de texte consignes ajout objet
if (typeof(consigneTextArea) != "undefined")
{
  consigneTextArea.addEventListener('click', function()
  {
    efface("Écrivez les consignes d'entrée pour l'objet en question...", consigneTextArea);
  })
}

// zone de texte ajout consignes dans fiche objet
if (typeof(textAreaConsigne) != "undefined")
{
  textAreaConsigne.addEventListener('click', function()
  {
    efface("Rentrez une consigne...", textAreaConsigne);
  })
}

// zone de texte smybologie
if (typeof(areaSymbologie) != "undefined")
{
  areaSymbologie.addEventListener('click', function()
  {
    efface("Code Symbologique", areaSymbologie);
  })
}

// zone de texte qui efface le texte lorsqu'on clique dedans pour qu'on puisse remplacer le texte
function efface(mot, area)
{
  if (area.value === mot)
  {
    area.value = '';
    area.style.color = 'black';
  } else {
    area.value = mot;
    area.style.color = "#8e8d8d";
  }
}