// -----------------fonction déploiement-----------------
$('.produitsDeploi').on('click', function(){
    if($('.produits' + this.id.slice(14) + ':visible').length > 0)
    {
        $(this).css('transform', 'rotate(0deg)');
        $('.produits' + this.id.slice(14)).slideUp();
    }
    else
    {
        $(this).css('transform', 'rotate(90deg)');
        $('.produits' + this.id.slice(14)).slideDown();
    }
  })
