
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    const formData = new FormData(this);

    fetch('contact.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'สำเร็จ!',
                    text: 'ข้อมูลถูกส่งและมีการแจ้งเตือนไปที่ TECH OR BIT CODE เรียบร้อยขอบคุณที่ติดต่อเรา',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                });
            } else {
                Swal.fire({
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถส่งข้อมูลได้ โปรดลองใหม่อีกครั้ง',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถส่งข้อมูลได้ โปรดลองใหม่อีกครั้ง',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            });
        });
});

