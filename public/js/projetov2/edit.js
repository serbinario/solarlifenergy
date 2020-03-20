$(document).ready(function () {
    var o = this;

    $('#rootwizard1').bootstrapWizard({
        onTabClick: function(tab, navigation, index){
            return true
        },
        onTabShow: function(tab, navigation, index) {
            handleTabShow(tab, navigation, index, $('#rootwizard1'));

        },

    });

    function handleTabShow(tab, navigation, index, wizard){
        var total = navigation.find('li').length;
        var current = index + 0;
        var percent = (current / (total - 1)) * 100;
        var percentWidth = 100 - (100 / total) + '%';
        //console.log(navigation)
        navigation.find('li').removeClass('done');
        navigation.find('li.active').prevAll().addClass('done');

        wizard.find('.progress-bar').css({width: percent + '%'});
        $('.form-wizard-horizontal').find('.progress').css({'width': percentWidth});
    };

    var count = 2
    var current = count + 0;
    var percent = (current / (4 - 1)) * 100;
    var percentWidth = 100 - (100 / 4) + '%';

    //$('#tabs-solar div.tab-pane').removeClass('active')
   // console.log($($('#tabs-solar div.tab-pane')[count]).addClass('active'))

    //for(i = 0 ; i < count ; i++){
       // $($( '#teste > li' )[i]).addClass('done');
    //}
   // count = 0

    //$('#rootwizard1').find('.progress-bar').css({width: percent + '%'});
    //$('.form-wizard-horizontal').find('.progress').css({'width': percentWidth});




    $(".add-more").click(function(){


        var html = '<div class="row copy">'
        html += '<div class="col-sm-3">'
        html +=     '<div class="form-group">'
        html +=         '<label for="num_contacontrato" class="col-sm-6 control-label text-bold">C/Contrato.:</label>'
        html +=         '<div class="col-md-6">'
        html += '           <div class="">'
        html +=                 '<label for="parecer_relacionamento">'
        html +=                     '<input class="form-control input-sm" name="num_contacontratoN[]" type="text" id="num_contacontrato[]" value="">'
        html +=                 '</label>'
        html +=             '</div>'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'
        html += '<div class="col-sm-1">'
        html += '   <div class="form-group">'
        html += '       <div class="col-md-4">'
        html += '           <div class="checkbox checkbox-styled">'
        html += '               <label>'
        html += '                   <input id="contrato_titularidadeN[]" class="" name="contrato_titularidadeN[]" type="checkbox" value="1" checked>'
        html += '               </label>'
        html += '           </div>'
        html += '       </div>'
        html += '   </div>'
        html += '</div>'
        html += '<div class="col-sm-2">'
        html +=     '<div class="form-group">'
        html +=         '<label for="percentual" class="col-sm-6 control-label text-bold">Percentual.:</label>'
        html +=         '<div class="col-md-6">'
        html +=             '<input class="form-control input-sm" name="percentualN[]" type="text" id="percentual" value="" placeholder="%">'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'
        html += '<div class="col-sm-5">'
        html += '   <div class="form-group">'
        html += '       <label for="image" class="col-sm-3 control-label text-bold">Link Arquivo</label>'
        html += '       <div class="col-md-9">'
        html += '           <input readonly class="form-control input-sm" name="imageN[]" type="file" id="image" value="">'
        html += '       </div>'
        html += '   </div>'
        html += '</div>'
        html += '<div class="col-sm-1">'
        html +=     '<div class="form-group">'
        html +=         '<div class="col-md-2">'
        html +=             '<button class="btn btn-danger remove btn-sm" type="button"><i class="glyphicon glyphicon-remove"></i></button>'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'
        html += '</div>'


        $(".after-add-more").before(html);

        $("body").on("click",".remove",function(){
            console.log("wwwww");
            $(this).parents(".copy").remove();
        });



    });

});