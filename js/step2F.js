(async () => {
    const {value: pais} = await Swal.fire({
        showConfirmButton: false,  
        icon: 'error', 
        text: 'Error', 
        backdrop: false, 
        toast: true, 
        position: 'center', 
        showCloseButton: true,
        width: 250, 
        padding: '0.5rem',
        background: '#fdfdfd',
        timer: 5000, 
        timerProgressBar: true
    });
})()