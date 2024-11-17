function showProjectDetails(project) {
    // Codificar los datos del proyecto usando JSON y encodeURIComponent
    const encodedData = encodeURIComponent(JSON.stringify(project));
    
    // Redirigir a la página de detalles con los datos codificados
    window.location.href = "<?= site_url('proyects/detalleProjet') ?>?data=" + encodedData;
}
