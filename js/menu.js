// -----------------fonction déploiement-----------------
$('.boutonDeploi').on('click', function(){
    if($('.' + this.id.slice(12) + ':visible').length > 0)
    {
        $(this).css('transform', 'rotate(0deg)');
        $('.' + this.id.slice(12)).slideUp();
    }
    else
    {
        $(this).css('transform', 'rotate(90deg)');
        $('ul').slideUp();
        $('.' + this.id.slice(12)).slideDown();
    }
  })
