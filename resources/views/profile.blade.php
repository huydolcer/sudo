<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/style.css'])
</head>
<body>
    <header class="bg-gray-800 p-6 text-white flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">User Profile</h1>
            <p class="mt-1">{{ Auth::check() ? Auth::user()->name : 'Chưa login' }}</p>
            <p>{{Auth::check() ? Auth::user()->email : 'Chưa login'}}</p>
        </div>
    </header>
    
    <div class="container mx-auto mt-8">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold">Ảnh đã lưu</th>
                        <th class="py-3 px-4 text-left font-semibold">Thời gian</th>
                        <th class="py-3 px-4 text-left font-semibold">Kích thước</th>
                        <th class="py-3 px-4 text-left font-semibold">Tên ảnh</th>
                        <th class="py-3 px-4 text-left font-semibold">Loại file</th>
                        <th class="py-3 px-4 text-center font-semibold">Chức năng xóa ảnh</th>
                    </tr>
                </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
<script>

function getCookie(name) {
    const cookieArr = document.cookie.split(";");
    for (let i = 0; i < cookieArr.length; i++) {
        const cookiePair = cookieArr[i].split("=");
        if (name === cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}
  const authUserId = @json(Auth::check() ? Auth::id() : null);
console.log(authUserId);
axios.get(`/profile/${authUserId}`).then(res => {
    const data = res.data;

    document.querySelector('tbody').innerHTML = data.map(file => {
        let fileDisplay;
        const fileExtension = file.name.split('.').pop().toLowerCase();
        let iconPath;

        // Kiểm tra phần mở rộng của tệp và chọn icon phù hợp
        switch (fileExtension) {
            case 'pdf':
                iconPath = '/img/pdf.png';
                break;
            case 'doc':
            case 'docx':
                iconPath = '/img/word.png';
                break;
            case 'xls':
            case 'xlsx':
                iconPath = '/img/excel.jpg';
                break;
            case 'zip':
            case 'rar':
                iconPath = '/img/zip-icon.png';
                break;
            case 'ppt':
            case 'pptx':
                iconPath = '/img/ppt.jpg';
                break;  
            default:
                iconPath = '/img/unknow.png';
        }

        if (file.type.startsWith('image/')) {
            // Nếu là ảnh, hiển thị thẻ <img>
            fileDisplay = `<img src="uploads/${file.path}" alt="${file.name}" class="h-16 w-16 object-cover">`;
        } else {
            // Đối với các loại tệp khác, hiển thị icon tương ứng với liên kết tải về
            fileDisplay = `<a href="${file.path}" target="_blank">
                <img src="${iconPath}" alt="${fileExtension}" class="h-8 w-8 inline-block mr-2">
                ${file.name}
            </a>`;
        }

        return `
            <tr>
                <td class="py-2 px-4 border-b">${fileDisplay}</td>
                <td class="py-2 px-4 border-b">${file.created_at}</td>
                <td class="py-2 px-4 border-b">${file.size} KB</td>
                <td class="py-2 px-4 border-b">${file.name}</td>
                <td class="py-2 px-4 border-b">${file.type}</td>
                <td class="py-2 px-4 border-b">
                    <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="deleteImage(${file.id})">Xóa</button>
                </td>
            </tr>
        `;
    }).join('');
});
function deleteImage(imageId) {
    // axios.delete(`/images/${imageId}`).then(res => {
    //     alert('Xóa ảnh thành công');
    //     window.location.reload();
    // });
}
</script>
</html>