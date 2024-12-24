// script.js

// ฟังก์ชันโหลดข้อมูลคู่มือจาก API
function loadManualContent() {
    fetch('api/get_manual.php')
        .then(response => response.json())
        .then(data => {
            const manualContentDiv = document.getElementById('manual-content');
            manualContentDiv.innerHTML = data.content;  // แสดงเนื้อหาที่ได้จาก API
        })
        .catch(error => console.log('Error:', error));
}

// ฟังก์ชันสลับการแสดง editor
function toggleEditor() {
    const editor = document.getElementById('editor');
    editor.style.display = editor.style.display === 'block' ? 'none' : 'block';
}

// ฟังก์ชันบันทึกเนื้อหาที่แก้ไข
function saveContent() {
    const content = document.getElementById('content-textarea').value;

    fetch('api/save_manual.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ content: content })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);  // แสดงข้อความแจ้งเตือน
        loadManualContent();  // โหลดเนื้อหาที่บันทึกใหม่
        toggleEditor();  // ซ่อน editor หลังจากบันทึก
    })
    .catch(error => console.log('Error:', error));
}

// เรียกใช้ฟังก์ชันเมื่อโหลดหน้าเว็บ
window.onload = function() {
    loadManualContent();  // โหลดเนื้อหาคู่มือ
};
