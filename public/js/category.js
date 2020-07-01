$(document).ready(function() {
    if(generals.length>0){
        allSelectEmpty();
        resetClassification(generals[0].id);
    }
});

$("#edit-general-btn").on("click",function(){
    var name = $("#general-select").children("option:selected").val();
    var id = $("#general-select").children("option:selected").data("id");
    if(!id)return;
    $("#edit-general-id").val(id);
    $("#edit-general-name").val(name);
    $('#edit-general-modal').modal('toggle');
});

$("#delete-general-btn").on("click",function(){
    var id = $("#general-select").children("option:selected").data("id");
    if(!id)return;
    $("#delete-general-id").val(id);
    $('#delete-general-modal').modal('toggle');
});

$("#add-classification-btn").on("click",function(){
    var generalId = $("#general-select").children("option:selected").data("id");
    if(!generalId){
        $('#message').html("Please select general!");
        $('#parent-confirm-modal').modal('toggle');
      return;  
    }
    $("#add-classification-general-id").val(generalId);
    $('#add-classification-modal').modal('toggle');
});

$("#edit-classification-btn").on("click",function(){
    var name = $("#classification-select").children("option:selected").val();
    var id = $("#classification-select").children("option:selected").data("id");
    if(!id)return;
    $("#edit-classification-id").val(id);
    $("#edit-classification-name").val(name);
    $('#edit-classification-modal').modal('toggle');
});

$("#delete-classification-btn").on("click",function(){
    var id = $("#classification-select").children("option:selected").data("id");
    if(!id)return;
    $("#delete-classification-id").val(id);
    $('#delete-classification-modal').modal('toggle');
});

$("#add-header-btn").on("click",function(){
    var classificationId = $("#classification-select").children("option:selected").data("id");
    if(!classificationId){
        $('#message').html("Please select classification!");
        $('#parent-confirm-modal').modal('toggle');
      return;  
    }
    $("#add-header-classification-id").val(classificationId);
    $('#add-header-modal').modal('toggle');
});

$("#edit-header-btn").on("click",function(){
    var name = $("#header-select").children("option:selected").val();
    var id = $("#header-select").children("option:selected").data("id");
    if(!id)return;
    $("#edit-header-id").val(id);
    $("#edit-header-name").val(name);
    $('#edit-header-modal').modal('toggle');
});

$("#delete-header-btn").on("click",function(){
    var id = $("#header-select").children("option:selected").data("id");
    if(!id)return;
    $("#delete-header-id").val(id);
    $('#delete-header-modal').modal('toggle');
});

$("#add-list-btn").on("click",function(){
    var headerId = $("#header-select").children("option:selected").data("id");
    if(!headerId){
        $('#message').html("Please select header!");
        $('#parent-confirm-modal').modal('toggle');
      return;  
    }
    $("#add-list-header-id").val(headerId);
    $('#add-list-modal').modal('toggle');
});

$("#edit-list-btn").on("click",function(){
    var name = $("#list-select").children("option:selected").val();
    var id = $("#list-select").children("option:selected").data("id");
    if(!id)return;
    $("#edit-list-id").val(id);
    $("#edit-list-name").val(name);
    $('#edit-list-modal').modal('toggle');
});

$("#delete-list-btn").on("click",function(){
    var id = $("#list-select").children("option:selected").data("id");
    if(!id)return;
    $("#delete-list-id").val(id);
    $('#delete-list-modal').modal('toggle');
});

$("#add-brand-btn").on("click",function(){
    var listId = $("#list-select").children("option:selected").data("id");
    if(!listId){
        $('#message').html("Please select list!");
        $('#parent-confirm-modal').modal('toggle');
      return;  
    }
    $("#add-brand-list-id").val(listId);
    $('#add-brand-modal').modal('toggle');
});

$("#edit-brand-btn").on("click",function(){
    var name = $("#brand-select").children("option:selected").val();
    var id = $("#brand-select").children("option:selected").data("id");
    if(!id)return;
    $("#edit-brand-id").val(id);
    $("#edit-brand-name").val(name);
    $('#edit-brand-modal').modal('toggle');
});

$("#delete-brand-btn").on("click",function(){
    var id = $("#brand-select").children("option:selected").data("id");
    if(!id)return;
    $("#delete-brand-id").val(id);
    $('#delete-brand-modal').modal('toggle');
});

$("#general-select").on("change",function(){
    var id = $(this).children("option:selected").data("id");
    allSelectEmpty();
    resetClassification(id);
});

$("#classification-select").on("change",function(){
    var id = $(this).children("option:selected").data("id");
    $("#header-select").empty();
    $("#list-select").empty();
    $("#brand-select").empty();
    resetHeader(id);
});

$("#header-select").on("change",function(){
    var id = $(this).children("option:selected").data("id");
    $("#list-select").empty();
    $("#brand-select").empty();
    resetList(id);
});

$("#list-select").on("change",function(){
    var id = $(this).children("option:selected").data("id");
    $("#brand-select").empty();
    resetBrand(id);
});

function resetClassification(generalId){
    var id = null;
    classifications.forEach(classification => {
        if(classification.pd_general_id==generalId){
            if(!id)id = classification.id;
            $("#classification-select").append("<option value="+classification.pd_classification+" data-id="+classification.id+">"+classification.pd_classification+"</option>");
        }
    });
    if(id)resetHeader(id);
}

function resetHeader(classificationId){
    var id = null;
    headers.forEach(header => {
        if(header.pd_classification_id==classificationId){
            if(!id)id = header.id;
            $("#header-select").append("<option value="+header.pd_header+" data-id="+header.id+">"+header.pd_header+"</option>");
        }
    });
    if(id)resetList(id);
}

function resetList(headerId){
    var id = null;
    pdLists.forEach(list => {
        if(list.pd_header_id==headerId){
            if(!id)id = list.id;
            $("#list-select").append("<option value="+list.pd_list+" data-id="+list.id+">"+list.pd_list+"</option>");
        }
    });
    if(id)resetBrand(id);
}

function resetBrand(listId){
    
    var id = null;
    brands.forEach(brand => {
        if(brand.pd_list_id==listId){
            if(!id)id = brand.id;
            $("#brand-select").append("<option value="+brand.pd_brand+" data-id="+brand.id+">"+brand.pd_brand+"</option>");
        }
    });
}

function allSelectEmpty(){
    $("#classification-select").empty();
    $("#header-select").empty();
    $("#list-select").empty();
    $("#brand-select").empty();
}

$('#add-general-submit').on('click', function(e) {
    e.preventDefault();
    var general = $('#add-general-name').val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#add-general-name').val('');
    $.ajax({
        url:"/createGeneral",
        method: "GET",
        data: {
            _token: CSRF_TOKEN,
            general:general
        },
        success:function(result)
        {
            general = result.general;
            $('#add-general-modal').modal('hide');
            $("#general-select").append("<option value="+general.pd_general+" data-id="+general.id+" selected>"+general.pd_general+"</option>");
            
            $('#classification-select').empty();
            $('#header-select').empty();
            $('#list-select').empty();
            $('#brand-select').empty();
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#edit-general-submit').on('click', function(e) {
    e.preventDefault();
    var general = $('#edit-general-name').val();
    var id = $('#edit-general-id').val();
    console.log(general);
    $.ajax({
        url:"/editGeneral",
        method: "GET",
        data: {general:general,id:id},
        success:function(result)
        {
            console.log(result);
            general = result.general;
            $('#edit-general-modal').modal('hide');
            $("#general-select").children("option:selected").html("<option value="+general.pd_general+" data-id="+general.id+" selected>"+general.pd_general+"</option>");
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#delete-general-submit').on('click', function(e) {
    e.preventDefault();
    var id = $('#delete-general-id').val();
    $.ajax({
        url:"/deleteGeneral",
        method: "GET",
        data: {id:id},
        success:function(result)
        {
            console.log(result.general);
            $('#delete-general-modal').modal('hide');
            $("#general-select").children("option:selected").remove();
            location.reload();
        },
        error:function (err) {
            console.log(err);
        },
    });
});

$('#add-classification-submit').on('click', function(e) {
    e.preventDefault();
    var general = $('#add-classification-general-id').val();
    var classification = $('#add-classification-name').val();
    $('#add-classification-name').val('');

    $.ajax({
        url:"/createClassification",
        method: "GET",
        data: {general:general,classification:classification},
        success:function(result)
        {
            console.log(result);
            classification = result.classification;
            $('#add-classification-modal').modal('hide');
            $("#classification-select").append("<option value="+classification.pd_classification+" data-id="+classification.id+" selected>"+classification.pd_classification+"</option>");
            $('#header-select').empty();
            $('#list-select').empty();
            $('#brand-select').empty();
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#edit-classification-submit').on('click', function(e) {
    e.preventDefault();
    var classification = $('#edit-classification-name').val();
    var id = $('#edit-classification-id').val();
    console.log(classification);
    $.ajax({
        url:"/editClassification",
        method: "GET",
        data: {classification:classification,id:id},
        success:function(result)
        {
            console.log(result);
            classification = result.classification;
            $('#edit-classification-modal').modal('hide');
            $("#classification-select").children("option:selected").html("<option value="+classification.pd_classification+" data-id="+classification.id+" selected>"+classification.pd_classification+"</option>");
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#delete-classification-submit').on('click', function(e) {
    e.preventDefault();
    var id = $('#delete-classification-id').val();
    $.ajax({
        url:"/deleteClassification",
        method: "GET",
        data: {id:id},
        success:function(result)
        {
            console.log(result.classification);
            $('#delete-classification-modal').modal('hide');
            $("#classification-select").children("option:selected").remove();
            location.reload();
        },
        error:function (err) {
            console.log(err);
        },
    });
});

$('#add-header-submit').on('click', function(e) {
    e.preventDefault();
    var classification = $('#add-header-classification-id').val();
    var header = $('#add-header-name').val();
    $('#add-header-name').val('');
    $.ajax({
        url:"/createHeader",
        method: "GET",
        data: {header:header,classification:classification},
        success:function(result)
        {
            console.log(result);
            header = result.header;
            $('#add-header-modal').modal('hide');
            $("#header-select").append("<option value="+header.pd_header+" data-id="+header.id+" selected>"+header.pd_header+"</option>");
            $('#list-select').empty();
            $('#brand-select').empty();
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#edit-header-submit').on('click', function(e) {
    e.preventDefault();
    var header = $('#edit-header-name').val();
    var id = $('#edit-header-id').val();
    console.log(header);
    $.ajax({
        url:"/editHeader",
        method: "GET",
        data: {header:header,id:id},
        success:function(result)
        {
            console.log(result);
            header = result.header;
            $('#edit-header-modal').modal('hide');
            $("#header-select").children("option:selected").html("<option value="+header.pd_header+" data-id="+header.id+" selected>"+header.pd_header+"</option>");
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#delete-header-submit').on('click', function(e) {
    e.preventDefault();
    var id = $('#delete-header-id').val();
    $.ajax({
        url:"/deleteHeader",
        method: "GET",
        data: {id:id},
        success:function(result)
        {
            console.log(result.header);
            $('#delete-header-modal').modal('hide');
            $("#header-select").children("option:selected").remove();
            location.reload();
        },
        error:function (err) {
            console.log(err);
        },
    });
});

$('#add-list-submit').on('click', function(e) {
    e.preventDefault();
    var header = $('#add-list-header-id').val();
    var list = $('#add-list-name').val();
    $('#add-list-name').val('');
    $.ajax({
        url:"/createList",
        method: "GET",
        data: {list:list,header:header},
        success:function(result)
        {
            console.log(result);
            list = result.list;
            $('#add-list-modal').modal('hide');
            $("#list-select").append("<option value="+list.pd_list+" data-id="+list.id+" selected>"+list.pd_list+"</option>");
            $('#brand-select').empty();
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#edit-list-submit').on('click', function(e) {
    e.preventDefault();
    var list = $('#edit-list-name').val();
    var id = $('#edit-list-id').val();
    console.log(list);
    $.ajax({
        url:"/editList",
        method: "GET",
        data: {list:list,id:id},
        success:function(result)
        {
            console.log(result);
            list = result.list;
            $('#edit-list-modal').modal('hide');
            $("#list-select").children("option:selected").html("<option value="+list.pd_list+" data-id="+list.id+" selected>"+list.pd_list+"</option>");
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#delete-list-submit').on('click', function(e) {
    e.preventDefault();
    var id = $('#delete-list-id').val();
    $.ajax({
        url:"/deleteList",
        method: "GET",
        data: {id:id},
        success:function(result)
        {
            console.log(result.list);
            $('#delete-list-modal').modal('hide');
            $("#list-select").children("option:selected").remove();
            location.reload();
        },
        error:function (err) {
            console.log(err);
        },
    });
});

$('#add-brand-submit').on('click', function(e) {
    e.preventDefault();
    var list = $('#add-brand-list-id').val();
    var brand = $('#add-brand-name').val();
    $('#add-brand-name').val('');
    $.ajax({
        url:"/createBrand",
        method: "GET",
        data: {brand:brand,list:list},
        success:function(result)
        {
            console.log(result);
            brand = result.brand;
            $('#add-brand-modal').modal('hide');
            $("#brand-select").append("<option value="+brand.pd_brand+" data-id="+brand.id+" selected>"+brand.pd_brand+"</option>");
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#edit-brand-submit').on('click', function(e) {
    e.preventDefault();
    var brand = $('#edit-brand-name').val();
    var id = $('#edit-brand-id').val();
    console.log(brand);
    $.ajax({
        url:"/editBrand",
        method: "GET",
        data: {brand:brand,id:id},
        success:function(result)
        {
            console.log(result);
            brand = result.brand;
            $('#edit-brand-modal').modal('hide');
            $("#brand-select").children("option:selected").html("<option value="+brand.pd_brand+" data-id="+brand.id+" selected>"+brand.pd_brand+"</option>");
        },
        error:function (err) {
            alert('You can not input same name.')
            console.log(err);
        },
    });
});

$('#delete-brand-submit').on('click', function(e) {
    e.preventDefault();
    var id = $('#delete-brand-id').val();
    $.ajax({
        url:"/deleteBrand",
        method: "GET",
        data: {id:id},
        success:function(result)
        {
            console.log(result.brand);
            $('#delete-brand-modal').modal('hide');
            $("#brand-select").children("option:selected").remove();
        },
        error:function (err) {
            console.log(err);
        },
    });
});