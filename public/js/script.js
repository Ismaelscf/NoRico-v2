function layout(){
    document.querySelector("#dataTable_length").style.display = 'inline-block';
    document.querySelector("#dataTable_filter").style.display = 'inline-block';
    document.querySelector("#dataTable_filter").style.float = 'right';

    document.querySelector(".dt-buttons").style.display = 'block';

    document.querySelector("#dataTable_info").style.display = 'inline-block';
    document.querySelector("#dataTable_paginate").style.display = 'inline-block';
    document.querySelector("#dataTable_paginate").style.float = 'right';
}

layout();