/**
    * Function show toast
    * @author   kkedzierski
    * @require  jQuery library
    * @param    {String} type       choose type of toast: info, warning, error, success
    * @param    {String} info       write information to display 
    * @param    {String} position   set position to display ex. bottom-center, top-left
    * @return   {void}         
*/
 const showToast = (type, info, position) => {
        
    //Add toastr css 
    const toastrCDN_CSS = 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css';
    
    if(document.querySelectorAll('[href="' + toastrCDN_CSS + '"]').length <= 0){
        let link = document.createElement('link'); 
        link.rel = 'stylesheet'; 
        link.href = toastrCDN_CSS; 
        document.head.appendChild(link);
    }
    //Add toastr cdn library
    const toastrCDNLib = "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    
    if(document.querySelectorAll('[src="' + toastrCDNLib + '"]').length <= 0){
        let toastScript = document.createElement('script');  
        toastScript.setAttribute('src', toastrCDNLib);
        document.head.appendChild(toastScript);
    }

    setTimeout(() => {
        toastr.options.positionClass = (`toast-${position}`);
        switch(type){
            case "info": 
                toastr.info(info);
                break;
            case "warning":
                toastr.warning(info);
                break;
            case "error":
                toastr.error(info);
                break;
            case "success":
                toastr.success(info);
                break;
            default:
                console.log("Set wrong type of toast");
        }
    },100);
}

const getErrorStatusDescription = (statusCode) => {
    switch(statusCode){
        case 404:
            return "Page not found";
        case 401:
            return "Unauthorized";
        case 0:
            return "Enter API Key";
        default:{
            return `${statusCode} code occured`;
        }
    }
}