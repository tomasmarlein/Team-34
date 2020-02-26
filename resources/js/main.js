export function hello(){
    console.log('Gladiolen JavaScript works! 🙂');

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



