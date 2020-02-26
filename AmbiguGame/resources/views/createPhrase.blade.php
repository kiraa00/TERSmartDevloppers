@extends('template')

@section('mainContent')

<h1> Create Phrase </h1>
<form name="ajouter phrase" method="post" action="insertPhrase">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div id="phrase_space" class="form-group">
        <textarea name="phraseD" id="phrase" required="required" placeholder="Saisissez votre phrase"></textarea>
        <button id="Mot_butt" type="button">Ajouter un mot ambigu</button>
    </div>
    <div id="Mots_space" class="form-group"></div>
    <button type="submit">Ajouter la phrase</button>
</form> 
<div class="modal fade" id="addGlose" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajouter Glose</h4>
            </div>
            <form id="glose_form" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <input id="glose_input" name="glose" placeholder="Saisissez une glose" class="form-control" type="text">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="hide_form()">Cancel</button>
                    <button type="button" id="btnAddGlose" class="btn btn-primary">Ajouter la glose</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });
    var i=0;
    var curr_selectId='';
    var curr_mot='';
    var mots_ajoute=[];
    $(document).ready(function(){
        $('#Mot_butt').click(add_mot);
        $('#btnAddGlose').click(function(){
            console.log("i m here");
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
                        +"<button type='button' id='"+buttonId+"'>Ajouter glose</button>"
                        +"<button id='"+sup_mot_id+"' type='button'>Supprimer Mot</button>"
                        +"</div>";

            $('#Mots_space').append(form);
            $('#'+sup_mot_id).click({id:divId, select:selection }, supp_mot);
            $('#'+buttonId).click({selectId:selectId, MotId:MotId}, show_form);
            i++;
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
</script>
@endsection