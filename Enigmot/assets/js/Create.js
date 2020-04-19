        var i=0;
    var curr_selectId='';
    var curr_mot='';
    var mots_ajoute=[];
    $(document).ready(function(){
        //ajouter glose dans la base de donnée
        $('#btnAddGlose').click(function(){
            console.log("adding the glose ...");
            var glose = $('#glose_input').val();
            var Mot = $('#'+curr_mot).val();
            ajouter_glose(glose);
            // $.post('ajouterGlose', {"_token": "{{ csrf_token() }}",glose:glose, motAmbigu:Mot}, function(data){
            //     console.log(data);
            // });
            // var dataSet = {"glose" : glose, "motAmbigu" : Mot}
            // $.ajax({
            //     type: "POST",
            //     url: "Create_Phrase/ajouterGlose",
            //     data: dataSet,
            //     success: function(data){
            //         console.log(data);
                    
            //         // raffraichirGlose();
            //         swal(
            //             'Good job!',
            //             'Data has been save!',
            //             'success'
            //         )                    
            //     }  
            // });
        });

        //ajouter le field MotAmbigu et récupérer les gloses associé
        $('#Mot_butt').click(function(){
            var mot = add_mot();
            $.ajax({
                type: "GET",
                url: "Create_Phrase/recuperer_Gloses/"+mot,
                success: function(data){
                    afficherGlose(data);
                }  
            });


        });

    });
    function raffraichirGlose(){
        for(var j=0;j<i;j++){
            var mot = $('#mot_ambigu'+j).val();
            var gloseID = '#gloses'+j;
            $.ajax({
                type: "GET",
                url: "Create_Phrase/recuperer_Gloses/"+mot,
                success: function(data){
                    console.log(data);
                    afficherGlose(data,gloseID);
                }  
            });
            
        }
    }

    function afficherGlose(data,glose=''){
        arr = JSON.parse(data);
        console.log(arr);
        $.each( arr, function( index, val ){
            var option="<option selected>"+val['Glose']+"</option>";
            if(glose == ''){
                $('#'+curr_selectId).append(option);
            }else{
                $('#'+curr_selectId).each(function(){
                    if (this.value == val['Glose'] ) {
                        console.log(value);
                        $(glose).append(option);
                    }
                });
                
            }
        });
    }

    function ajouter_glose(value){
        //ajoute la glose dans select
        let option="<option>"+value+"</option>";
        $('#'+curr_selectId).append(option);
        hide_form();
    }    
    function add_mot(){
        let selection = '';
        $('#phrase').focus();
        selection = window.getSelection();
        selectionTest = selection.toString().replace( /\s/g, '');
        // && jQuery.inArray( selection , mots_ajoute)==-1
        if(selectionTest != ''){
            mots_ajoute.push(selection);
            let divId='mot'+i;
            let selectId = 'gloses'+i;
            let buttonId = 'ajouter_glose'+i;
            let MotId = 'mot_ambigu'+i;
            let sup_mot_id='supprimer_mot'+i;
            let form =  "<div id='"+divId+"'>"
                        +"<label for='"+MotId+"'>Mot ambigu:  </label>"
                        +"<input name='mot_ambiguD[]' type='text' id='"+MotId+"' value='"+selection+"'/>"
                        +"<label for='"+selectId+"'>Glose:    </label>"
                        +"<select name='gloseD[]' id='"+selectId+"' required='required' multiple='multiple'>"
                        +"<option selected disabled>Choisissez une glose</option>"
                        +"</select>"
                        +"<button class='registerbtn' type='button' id='"+buttonId+"'>Ajouter glose</button>"
                        +"<button class='registerbtn2' id='"+sup_mot_id+"' type='button'>Supprimer Mot</button>"
                        +"</div>";
             curr_selectId=selectId;
            $('#Mots_space').append(form);
            $('#'+sup_mot_id).click({id:divId, select:selection }, supp_mot);
            $('#'+buttonId).click({selectId:selectId, MotId:MotId}, show_form);
            i++;
            $('#phrase').selection('replace', {text: "<amb id = \'"+i+"\'>"+ selection + "</amb>"});
            return selection;
        }
    }
    function supp_mot(param){
        mots_ajoute = $.grep(mots_ajoute, function(value) {
                return value != param.data.select;
            });
        let id="#"+param.data.id;
        $(id).remove();

    }
    function show_form(param){
        console.log(mots_ajoute);
        curr_selectId=param.data.selectId;
        curr_mot=param.data.MotId;
        $('#glose_form')[0].reset(); // reset form on modals
        $('#addGlose').modal('show'); // show bootstrap modal
    }




    function hide_form(){
        curr_selectId='';
        curr_mot='';
        $('#addGlose').modal('hide');
    }
