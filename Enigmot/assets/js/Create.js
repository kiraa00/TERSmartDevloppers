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
            // $.post('ajouterGlose', {"_token": "{{ csrf_token() }}",glose:glose, motAmbigu:Mot}, function(data){
            //     console.log(data);
            // });
            var dataString = "glose="+glose+"&motAmbigu="+Mot;
            $.ajax({
                type: "POST",
                url: "ajouterGlose",
                data: dataString,
                success: function(data){
                    console.log(data);
                    ajouter_glose(glose);
                }  
            });
        });

        //ajouter le field MotAmbigu et récupérer les gloses associé
        $('#Mot_butt').click(function(){
            var dataString = "mot="+add_mot();

            $.ajax({
                type: "GET",
                url: "recupererGloses",
                data: dataString,
                success: function(data){
                    console.log(data);
                }  
            });


        });

    });

    function ajouter_glose(value){
        let option="<option>"+value+"</option>"
        $('#'+curr_selectId).append(option);
        hide_form();
    }    
    function add_mot(){
        let selection = '';
        $('textarea').focus();
        selection = window.getSelection();
        selection = selection.toString().replace( /\s/g, '');
        if(selection!='' && jQuery.inArray( selection , mots_ajoute)==-1){
            mots_ajoute.push(selection);
            let divId='mot'+i;
            let selectId = 'gloses'+i;
            let buttonId = 'ajouter_glose'+i;
            let MotId = 'mot_ambigu'+i;
            let sup_mot_id='supprimer_mot'+i;
            let form =  "<div id='"+divId+"'>"
                        +"<label for='"+MotId+"'>Mot ambigu:  </label>"
                        +"<input name='mot_ambiguD' type='text' id='"+MotId+"' value='"+selection+"'/>"
                        +"<label for='"+selectId+"'>Glose:    </label>"
                        +"<select name='gloseD' id='"+selectId+"' required='required'>"
                        +"<option selected disabled>Choisissez une glose</option>"
                        +"</select>"
                        +"<button class='registerbtn' type='button' id='"+buttonId+"'>Ajouter glose</button>"
                        +"<button class='registerbtn2' id='"+sup_mot_id+"' type='button'>Supprimer Mot</button>"
                        +"</div>";

            $('#Mots_space').append(form);
            $('#'+sup_mot_id).click({id:divId, select:selection }, supp_mot);
            $('#'+buttonId).click({selectId:selectId, MotId:MotId}, show_form);
            i++;
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