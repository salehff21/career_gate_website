function showMessage(message, type = 'info') {
    const box = document.createElement('div');
    box.textContent = message;
    box.style.position = 'fixed';
    box.style.top = '20px';
    box.style.right = '20px';
    box.style.zIndex = 9999;
    box.style.padding = '12px 20px';
    box.style.borderRadius = '8px';
    box.style.fontFamily = 'Cairo, sans-serif';
    box.style.fontSize = '16px';
    box.style.color = '#fff';
    box.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
    box.style.transition = 'opacity 0.4s ease-in-out';

    // اللون حسب نوع الرسالة
    if (type === 'success') {
        box.style.backgroundColor = '#28a745';
    } else if (type === 'error') {
        box.style.backgroundColor = '#dc3545';
    } else {
        box.style.backgroundColor = '#007bff';
    }

    document.body.appendChild(box);
    setTimeout(() => box.style.opacity = '0', 2000);
    setTimeout(() => box.remove(), 2500);
}
