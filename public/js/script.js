function previewImage() {
    const svg = document.getElementById(`svg`);
    const success = document.getElementById(`success-message`);
    svg.style.display = 'none';
    success.style.display = 'block';
}

function previewAgentImage(event, index) {
    const input = event.target;
    const preview = document.getElementById(`agentImagePreview${index}`);
    const svg = document.getElementById(`agentSvg${index}`);
    const fileIcon = document.getElementById(`agentFileIcon${index}`);

    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileType = file.type;

        if (fileType === "application/pdf") {
            preview.style.display = 'none';
            svg.style.display = 'none';
            fileIcon.style.display = 'block';
        } else if (fileType.startsWith("image/")) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                // preview.style.display = 'block';
                preview.width = 100;
                preview.height = 100;
                svg.style.display = 'none';
                fileIcon.style.display = 'none';
            };

            reader.readAsDataURL(file);
        }
    } else {
        preview.src = "";
        preview.style.display = 'none';
        fileIcon.style.display = 'none';
        svg.style.display = 'block';
    }
}


const current = new Date();
const maxDate = `${current.getFullYear()}-${String(current.getMonth() + 1).padStart(2, '0')}-${String(current.getDate()).padStart(2, '0')}`;

// const dateInputs = document.querySelectorAll('#dateInput');
// dateInputs.forEach(input => {
//     input.max = maxDate;
// });

function updateDateTime() {
    const now = new Date();
    const date = now.toISOString().split('T')[0];
    const time = now.toTimeString().split(' ')[0];

    if(document.getElementById('currentDate')) {
        document.getElementById('currentDate').textContent = date;
        document.getElementById('currentTime').textContent = time;
    }

    if(document.getElementById('registerDate')) {
        document.getElementById('registerDate').value = date;
        document.getElementById('registerTime').value = time;
    }
}

function updateQRCode() {
    const now = new Date();
    const date = now.toISOString().split('T')[0];
    const time = now.toTimeString().split(' ')[0];
    const qrCodeData = JSON.stringify({ Date: date, Time: time });
    const qrCodeImg = document.getElementById('qrCodeImg');
    qrCodeImg.src = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(qrCodeData)}&size=320x320`;
}

document.addEventListener('DOMContentLoaded', (event) => {
    updateDateTime();
    setInterval(updateDateTime, 1000);
    updateQRCode();
    setInterval(updateQRCode, 30000);
    document.getElementById('updateQrCodeBtn').addEventListener('click', updateQRCode);
});


$("#type").on('change', function() {
    var selectedValue = $(this).val();

    // Liste des sections
    var sections = [
        { class: '.allaitement', value: 'Attestation allaitement' },
        { class: '.service_maternite', value: 'Attestation de reprise de service maternité' },
        { class: '.attestation_travail', value: 'Attestation travail' },
        { class: '.certificat_travail', value: 'Certificat de travail' },
        // { class: '.autorisation_absence', value: "Décision autorisation d'absence" },
        { class: '.prise_service', value: 'Prise de service' }
    ];

    sections.forEach(section => {
        if (selectedValue === section.value) {
            $(section.class).removeClass('d-none').find('input, select, textarea').prop('disabled', false);
        } else {
            $(section.class).addClass('d-none').find('input, select, textarea').prop('disabled', true);
        }
    });
});

