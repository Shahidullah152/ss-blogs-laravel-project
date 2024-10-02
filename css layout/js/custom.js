let  sidebar_hide_show_btn = document.querySelector('#sidebar-hide-show-btn')
let sidebar = document.querySelector('.sidebar');
let main_section = document.querySelector('.main');
sidebar_hide_show_btn.addEventListener('click',()=>{
    sidebar.classList.toggle('side-hide')
    main_section.classList.toggle('margin_0');

});


//  search show icon js

let search_show_icon =
document.querySelector('#search-show-icon');
let search_input = document.querySelector('.search-hide');
let show_input_hide_btn = document.querySelector('#show-input-hide-btn');
search_show_icon.addEventListener('click',()=>{
    search_input.classList.toggle('search-show');
    });

    show_input_hide_btn.addEventListener('click',()=>{
        search_input.classList.remove('search-show');
    })
    //  search show icon js end
