/**
 * 
 * Add Dynamic Content
 * 
 */
// Add Dynamic input for user profile social media

function DYInputs()  {}
function LocalStorage()  {}

DYInputs.prototype.AddNewInput = function(){

    const dy_wrapper = document.getElementById('dy_wrapper');
    const social_media = document.getElementById('social_media');
    const add_more = document.getElementById('add_more');
    const network_wrapper = document.getElementById('network_wrapper');
    const social_media_val = social_media.value;

    if( social_media_val === '' ){
        DYInputs.prototype.Alert( 'Please Fill the form', 'danger' );
        return;
    }

    let social_media_input = dy_wrapper.querySelectorAll( '.social-media-input' );
    social_media_input = [...social_media_input];

    const value_matches =  social_media_input.filter( item => item.value === social_media_val );

    if( value_matches.length === 1 ){
        DYInputs.prototype.Alert( 'Link is exists', 'warning' );
        return;
    }

    let new_input = '';
    new_input = `
        <li class="list-group-item p-h-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-icon" style="color: #4267b1; background: rgba(66, 103, 177, 0.1);">
                        <i class="anticon anticon-${social_media_val.split('.')[1]}"></i>
                    </div>
                    <div class="font-size-15 font-weight-semibold m-l-15">${social_media_val.split('.')[1].toUpperCase()}</div>
                </div>
                <div class="d-flex align-items-center">
                    <label class="m-b-0">${social_media_val}</label>
                    <div class="switch m-t-5 m-l-10">
                        <input type="checkbox" checked name="network[${social_media_val.split('.')[1]}]" value="${social_media_val}" id="${social_media_val.split('.')[1]}"  />
                        <label for="${social_media_val.split('.')[1]}"></label>
                    </div>
                </div>
            </div>
        </li>
    `;

    network_wrapper.innerHTML += new_input;
    
    social_media.value = '';
    DYInputs.prototype.Alert( 'Scoial media likn add succesfully', 'success' );
    const media = {
        media : `${social_media_val.split('.')[1]}`,
        link : `${social_media_val}`,
        state : `checked`
    };

    LocalStorage.prototype.AddSocialMedia(media);
}

DYInputs.prototype.Alert = function( msg, type ){
    const err_msg = document.querySelector('.err-msg');
        err_msg.innerText = msg;
        err_msg.classList.add( 'text-' + type );
    // Delete the alert msg
    setTimeout(function(){
        err_msg.innerText = '';
    }, 6000);
}

LocalStorage.prototype.GetSocialMedia = function(){

    let social_media;
    if( localStorage.getItem( 'media' ) === null ){
        social_media = [];
        return social_media;
    }
    social_media = JSON.parse( localStorage.getItem( 'media' ) );
    return social_media;
}

LocalStorage.prototype.AddSocialMedia = function(media){
    let social_media = LocalStorage.prototype.GetSocialMedia();
    social_media.push(media);
    localStorage.setItem( 'media', JSON.stringify(social_media) );
}

LocalStorage.prototype.DisplaySocialMedia = function(){
    let social_media = LocalStorage.prototype.GetSocialMedia();
    const network_wrapper = document.getElementById('network_wrapper');
    social_media.forEach( media => {
        let new_input = '';
        new_input = `
            <li class="list-group-item p-h-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-icon" style="color: #4267b1; background: rgba(66, 103, 177, 0.1);">
                            <i class="anticon anticon-${media.media}"></i>
                        </div>
                        <div class="font-size-15 font-weight-semibold m-l-15">${media.media.toUpperCase()}</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="m-b-0">${media.link}</label>
                        <div class="switch m-t-5 m-l-10">
                            <input type="checkbox" ${media.state} name="network[${media.media}]" value="${media.link}" id="${media.media}"  />
                            <label for="${media.media}"></label>
                        </div>
                    </div>
                </div>
            </li>
        `;

        network_wrapper.innerHTML += new_input;
    });
}


document.addEventListener( 'DOMContentLoaded', function(){

    const alerts = [...document.querySelectorAll('.alert')];

    alerts.forEach( alert => {
        setTimeout( () =>{
            alert.remove();
        }, 5000 );
    })

    var DyInputs = new DYInputs();

    const add_more_btn = document.getElementById( 'add_more' );

    add_more_btn.addEventListener( 'click' , function(e){
        DyInputs.AddNewInput();
        e.preventDefault();
    });

    LocalStorage.prototype.DisplaySocialMedia();

    document.querySelector('#network_wrapper').addEventListener('click', function(e){
        
        if( e.target.id === '' ){
            return;
        }
        const input_id = e.target.id;
        let local_storage = localStorage.getItem('media');
        local_storage = JSON.parse(local_storage);
        const matches = local_storage.find( input => input.media === input_id );

        if( matches.state !== '' ){
            matches.state = '';
        }else{
            matches.state = 'checked';
        }

        localStorage.setItem( 'media', JSON.stringify(local_storage) );
    });


});
