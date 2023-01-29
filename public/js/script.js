function selectSort() {
    let type = document.querySelector('#type').value;
    let lojas = document.querySelector('#store_id');
}

function countDocument(document){

    if(document.value.length >= 14){
        return $(document).mask('00.000.000/0000-00');
    } else {
        return $(document).mask('000.000.000-00');
    }
}