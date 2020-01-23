export function hello(){
    console.log('The Vinyl Shop JavaScript works! 🙂');

    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        html : true,
    });

    Noty.overrideDefaults({
        layout: 'topRight',
        theme: 'bootstrap-v4',
        timeout: 3000
    });
}



