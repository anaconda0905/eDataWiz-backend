$(document).ready(function() {
    if(generals.length>0 ){
        if (typeof question === 'undefined'){
            allSelectEmpty();
            resetClassification(generals[0].id);
        }
    }
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
    $("#dlist-select").empty();
    $("#brand-select").empty();
    resetHeader(id);
});

$("#header-select").on("change",function(){
    var id = $(this).children("option:selected").data("id");
    $("#list-select").empty();
    $("#dlist-select").empty();
    $("#brand-select").empty();
    resetList(id);
});

$("#list-select").on("change",function(){
    var id = $(this).children("option:selected").data("id");
    $("#dlist-select").empty();
    $("#brand-select").empty();
    resetDList(id);
});

$("#dlist-select").on("change",function(){
    var id = $(this).children("option:selected").data("id");
    $("#brand-select").empty();
    resetBrand(id);
});

function resetClassification(generalId){
    var id = null;
    classifications.forEach(classification => {
        if(classification.pd_general_id==generalId){
            if(!id)id = classification.id;
            $("#classification-select").append("<option value="+classification.id+" data-id="+classification.id+">"+classification.pd_classification+"</option>");
        }
    });
    if(id)resetHeader(id);
}

function resetHeader(classificationId){
    var id = null;
    headers.forEach(header => {
        if(header.pd_classification_id==classificationId){
            if(!id)id = header.id;
            $("#header-select").append("<option value="+header.id+" data-id="+header.id+">"+header.pd_header+"</option>");
        }
    });
    if(id)resetList(id);
}

function resetList(headerId){
    var id = null;
    pdLists.forEach(list => {
        if(list.pd_header_id==headerId){
            if(!id)id = list.id;
            $("#list-select").append("<option value="+list.id+" data-id="+list.id+">"+list.pd_list+"</option>");
        }
    });
    if(id)resetDList(id);
}

function resetDList(listId){
    
    var id = null;
    dpdLists.forEach(dlist => {
        if(dlist.pd_lists_id==listId){
            if(!id)id = dlist.id;
            $("#dlist-select").append("<option value="+dlist.id+" data-id="+dlist.id+">"+dlist.dpd_list+"</option>");
        }
    });
    if(id)resetBrand(id);
}

function resetBrand(listId){
    
    var id = null;
    brands.forEach(brand => {
        if(brand.dpd_list_id==listId){
            if(!id)id = brand.id;
            $("#brand-select").append("<option value="+brand.id+" data-id="+brand.id+">"+brand.pd_brand+"</option>");
        }
    });
}

function allSelectEmpty(){
    $("#classification-select").empty();
    $("#header-select").empty();
    $("#list-select").empty();
    $("#dlist-select").empty();
    $("#brand-select").empty();
}