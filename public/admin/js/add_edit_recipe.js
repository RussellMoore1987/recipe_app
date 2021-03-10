$(document).ready(function() {
    // set focus
    var titleText = $('#title').val();
    $('#title').val(' ' + titleText).focus();


    $('#add_button').click(function(){
        $('#recipe_ingredient_table tr:last' ).after('<tr><td><input class="ingredient" name="ingredient_whole_amount" id="ingredient_whole_amount" type="number">' +
        '<td><select class="ingredient" name="ingredient_partial_amount" id="ingredient_partial_amount">' +
        '<option value=0.0>(none)</option><option value=0.125>1/8</option><option value=0.25>1/4</option>' +
        '<option value=0.33>1/3</option><option value=0.5>1/2</option><option value=0.625>5/8</option>' +
        '<option value=0.667>2/3</option><option value=0.75>3/4</option><option value=0.875>7/8</option></select>' +
        '</td><td><select class="ingredient" name="ingredient_unit" id="ingredient_unit"><option value="pinch">Pinch</option><option value="teaspoons">Teaspoon(s)</option>' +
        '<option value="tablespoons">Tablespoon(s)</option> <option value="cups">Cup(s)</option><option value="ounces">Ounce(s)</option><option value="quarts">Quart(s)</option>' +
        '<option value="pounds">Pound(s)</option><option value="count">Count</option></select></td><td><input class="ingredient" name="ingredient" id="ingredient" type="text"></td>' +
        '<td><button type="button" class="del_button">Remove</button></td></tr>')
    });

    $('#recipe_ingredient_table').on('click', '.del_button', function(){
        $(this).closest('tr').remove();
    });

    $('#prep_time').change(function(){
        var prep = 0;
        var cook = 0;
        if($('#prep_time').val().length){
            prep = parseInt($('#prep_time').val());
            }
        if($('#cook_time').val().length){
            cook = parseInt($('#cook_time').val());
            }
        var total = prep + cook;
        $('#total_time').val(total)
    });

    $('#cook_time').change(function(){
        var prep = 0;
        var cook = 0;
        if($('#prep_time').val().length){
            prep = parseInt($('#prep_time').val());
            }
        if($('#cook_time').val().length){
            cook = parseInt($('#cook_time').val());
            }
        var total = prep + cook;
        $('#total_time').val(total)
    });


    $('#main_form').submit(function(){
        $('#recipe_is_private').val(this.checked ? 1 : 0);
        var newFormData=[];
        $('#recipe_ingredient_table tr:not(:first)').each(function(i){
            var tb=$(this);
            var obj={};
            tb.find('.ingredient').each(function(){
                obj[this.name]=this.value;
            });
            obj['row']=i;
            newFormData.push(obj);
        });
        console.log(newFormData)
        $('#recipe_ingredients').val(JSON.stringify(newFormData));


    });

    $('#delete_button').click(function(){
        var choice = confirm('Do you really want to delete this recipe?');
        if(choice === true) {
            $('#delete').val(true);
        }

    });


}); 