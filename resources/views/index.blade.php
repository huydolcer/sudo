<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/style.css'])
    <style>
        *{
            font-family:'Open Sans', sans-serif;
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="w-full min-w-full border-b border-slate-300 h-12 flex justify-between items-center px-2 fixed navbar z-40">
        <nav class="header-item flex text-base">
            <div class="start1">
                <span class="hover:text-cyan-700">
                    <i class="fa-regular fa-circle-question"></i>
                </span>
                <a href="" class="ml-2 text-base" id="dropdown1">Giới thiệu <i class="fa-solid fa-caret-down"></i></a>
                    <ul class="none_display1">
                        <li><i class="fa-solid fa-code"></i> Puglic</li>
                        <li><i class="fa-solid fa-gear"></i> API</li>
                        <li><i class="fa-solid fa-building-columns"></i> Terms of service</li>
                        <li><i class="fa-solid fa-lock"></i> Privacy</li>
                        <li><i class="fa-solid fa-at"></i> Contact</li>
                    </ul>
            </div>
                <div class="start2">
                    <a href="" class="ml-3"><i class="fa-solid fa-language" id="dropdown2"></i> VI</a>
                <ul class="show_language" style="display: none">
                    <li>Tiếng Việt</li>
                    <li>English</li>
                    <li>Español</li>
                    <li>Français</li>
                    <li>Deutsch</li>
                    <li>Italiano</li>
                    <li>Português</li>
                    <li>Русский</li>
                    <li>中文 (Zhōngwén)</li>
                    <li>日本語 (Nihongo)</li>
                    <li>한국어 (Hangul)</li>
                    <li>العربية (Al-‘Arabīyah)</li>
                    <li>हिन्दी (Hindi)</li>
                    <li>বাংলা (Bangla)</li>
                    <li>ไทย (Thai)</li>
                    <li>فارسی (Farsi)</li>
                    <li>Türkçe</li>
                    <li>Polski</li>
                    <li>Ελληνικά (Greek)</li>
                    <li>Nederlands</li>

            </ul>
                </div>
            </nav>
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </div>  
            <div class="header-end flex justify-between items-center">
                <span id="offcanvas-button" onclick="toggleOffcanvas()" class="upload_file hover:text-sky-400">
                    <i class="fa-solid fa-cloud-arrow-up hover:text-sky-400"></i> Upload</span>
                <div class="auth-login">
                    @if(auth()->check())
                    <span class="text-gray-800 ml-3">
                        <a href="{{ route('profile') }}" class="hover:text-sky-600">{{ Auth::user()->name }}</a>
                        <input type="hidden" id="userId-auth" value="{{ Auth::user()->id }}">
                    </span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300">Đăng xuất</button>
                    </form>
                    @else
                    <a href="{{ route('profile') }}" class="hover:text-sky-700 ml-2">Views My File </a>
                    <span class="hover:text-sky-400"onclick="window.location.href='/login/'"><i class="fa-solid fa-right-to-bracket ml-3 hover:text-sky-400" ></i> Đăng nhập</span>
                <a href="{{ route('direction-regisn') }}" class="bg-sky-600 ml-2 regisn rounded text-white">Đăng kí</a>
                @endif
                </div>
            </div>
        </div>
       <div class="bgr-blur">
        <div class="home_cover mx-auto z-20 h-auto pb-48">
            <h1 class="font-bold text-center title">Đăng và chia sẻ những bức ảnh của bạn</h1>
            <p class="text-center text-2xl center-box color-[#333333] content">Drag and drop anywhere you want and start uploading your images now.
                 32 MB limit. Direct image links, BBCode and HTML thumbnails.</p>
                 <div class="home_buttons flex justify-center pt-2">
                    <input type="file" id="fileInput" class="hidden filepond" accept="image/*,.pdf,.doc,.docx" multiple>
                    <a href="#" class="text-white uppercase bg-sky-600 mx-auto start_upload">START UPLOADING</a>
                </div>
        </div>
        <div id="offcanvas" class="offcanvas fixed top-0 left-0 right-0 bg-white shadow-lg offcanvas-hidden z-20">
            <div class="p-4 mt-14">
                <div class="content flex justify-between">
                    <div class="titles p-0">
                        <span class="uppercase p-0 line_sp">JPG PNG BMP GIF TIF WEBP HEIC AVIF PDF 32 MB</span>
                    </div>
                    <div class="btn_close">
                        <span class="uppercase mr-2 line_sp hidden" id="btn-reset" onclick="checkReset()"><i class="fa-solid fa-arrow-rotate-left"></i> reset</span>
                    </div>
                </div>
               <div class="contents-upload-files">
                {{--  --}}
                <div class="description pt-20 pb-20 hidden">
                    <div class="btn-closes absolute top-16 right-1">
                        <span class="uppercase mr-2 line_sp" id="close-button"><i class="fa-solid fa-xmark"></i> Đóng</span>
                    </div>
                    <div class="icons flex items-center justify-center">
                        <span class="text-cyan-600">
                            <i class="fa-solid fa-cloud-arrow-up text-sky-600 text-8xl"></i>
                        </span>
                    </div>
                    <div class="noidung" id="dropZone">
                        <a class="text-center flex items-center justify-center keotha">Kéo thả hoặc paste (Ctrl + V) ảnh vào đây để upload</a>
                        <br>
                        <div class="upload_box flex items-center justify-center">
                            <span class="text-sm font-size-[16px]">Bạn có thể <a href="" class="text-sky-300 click_upload">tải lên từ máy tính</a> hoặc <a href="" class="text-sky-300">thêm địa chỉ ảnh</a></span>
                        </div>
                    </div>
                    
                </div>
                
                
               </div>

               <div class="file_ative hidden">
                <span class="flex justify-center items-center">
                    <i class="fa-solid fa-images text-8xl text-sky-600"></i>
                </span>
                <h2 class="flex justify-center text-2xl my-3">
                    <a href="">Sửa hoặc chỉnh cỡ bất kì ảnh nào bởi nhấp vào xem thử</a>
                </h2>
                        <div class="upload_box flex justify-center">
                            Bạn có thể thêm nhiều ảnh nữa từ <a href="" class="text-sky-300 decoration-active mx-1"> máy tính của bạn </a> hoặc <a href=""
                            class="text-sky-300 decoration-active mx-1"> thêm địa chỉ ảnh</a>.
                        </div>

                <div class="img-box flex justify-center items-center">
                    {{-- Các hình ảnh được tải lên sẽ hiển thị ở đây --}}
                </div>
                <div class="time_delete">
                    <div class="content_delete w-[310px] mx-auto">
                        <span class="font-bold flex justify-start items-end">Tự động xóa ảnh</span>
                    </div>
                    <div class="select_delete flex justify-center">
                        <select class="bg-[#eeeeee] w-[310px] p-[7px_10px_7px_7px] rounded-sm" id="deleteTime">
                            <option value="0">Không xóa</option>
                            <option value="30">30 giây</option>
                            <option value="60">1 phút</option>
                            <option value="1800">30 phút</option>
                            <option value="3600">1 giờ</option>
                            <option value="10800">3 giờ</option>
                            <option value="21600">6 giờ</option>
                            <option value="43200">12 giờ</option>
                            <option value="86400">1 ngày</option>
                            <option value="259200">3 ngày</option>
                            <option value="604800">1 tuần</option>
                            <option value="1209600">2 tuần</option>
                            <option value="2592000">1 tháng</option>
                            <option value="7776000">3 tháng</option>
                            <option value="15552000">6 tháng</option>
                            <option value="31536000">1 năm</option>
                        </select>                        
                    </div>
                    <div class="btn_Upload flex justify-center mt-4">
                        <button class="bg-[#27AE61] p-[12px_30px] text-white uppercase tracking-widest rounded-sm" onclick="uploadFiles()">upload</button>
                    </div>
                </div>
                
            </div>
            
                <div class="upload_done hidden">
                    <div class="icon_check flex justify-center items-center">
                        <i class="fa-solid fa-circle-check text-8xl text-[#27AE61]"></i>
                    </div>
                    <div class="haeding">
                        <h2 class="text-center text-2xl mx-3">Upload xong rồi!</h2>
                    </div>
                    <div class="content-done-upload text-center w-[630px] mx-auto my-1">
                        <span class="text-center">You can <a href="" class="text-sky-300">tạo album mới</a> with the content just uploaded.
                            You must <a href="" class="text-sky-300">tạo tài khoản or đăng nhập</a> to save this content into your account.</span>
                    </div>
                    <div class="img_upload_backend flex justify-center my-9">
                        <img src="{{ asset('img/01.jpg') }}" alt="" class="w-[100px] h-[100px] object-cover">
                    </div>
            
                    
                    
                </div>
               </div>
               {{--  --}}
            </div>
        </div>


    
        
        <div class="bgr-blur about w-full h-80">
            <div class="tet">

            </div>
        </div>

        
    </div>
    
</body>
<script> 


    const dropZone = document.getElementById('dropZone');
function checkFile() {
    const img = document.querySelectorAll(".img-box img");
    if (img.length > 0) {
        document.querySelector('.description').classList.add('hidden');
        document.querySelector('.file_ative').classList.remove('hidden');   
    } else {
        document.querySelector('.description').classList.remove('hidden');
        document.querySelector('.file_ative').classList.add('hidden');
        document.querySelector('#close-button').classList.remove('hidden');
        document.querySelector('#btn-reset').classList.add('hidden');

    }
}
checkFile();
let selectedFiles = [];

function handleFileUpload(files) {
    document.querySelector('.img-box').innerHTML = '';
    document.querySelector('#btn-reset').classList.remove('hidden');
    for (let i = 0; i < files.length; i++) {
        let file = files[i];
        selectedFiles.push(file);
        let reader = new FileReader();

        if (file.type.startsWith('image/')) {
            reader.onload = function() {
                let imgWrapper = document.createElement('div');
                imgWrapper.style.position = 'relative';
                imgWrapper.style.display = 'inline-block';
                imgWrapper.style.margin = '35px';

                let img = document.createElement('img');
                img.src = reader.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';

                let delete_btn = document.createElement('button');
                delete_btn.innerHTML = '<i class="fa-solid fa-x text-xs"></i>';
                delete_btn.style.position = 'absolute';
                delete_btn.style.top = '-0.3rem';
                delete_btn.style.left = '-0.3rem';
                delete_btn.style.background = 'white';
                delete_btn.style.color = 'black';
                delete_btn.style.border = 'none';
                delete_btn.style.borderRadius = '50%';
                delete_btn.style.width = '20px';
                delete_btn.style.height = '20px';
                delete_btn.style.cursor = 'pointer';
                delete_btn.style.boxShadow = '0px 4px 6px rgba(0, 0, 0, 0.3)';
                delete_btn.style.display = 'flex';
                delete_btn.style.alignItems = 'center';
                delete_btn.style.justifyContent = 'center';
                delete_btn.addEventListener('click', function() {
                    imgWrapper.remove();
                    checkFile();
                });

                imgWrapper.appendChild(img);
                imgWrapper.appendChild(delete_btn);
                document.querySelector('.img-box').appendChild(imgWrapper);
                checkFile();
            };
            reader.readAsDataURL(file);
        } else {
            let fileIcon = document.createElement('div');
            fileIcon.style.width = '100px';
            fileIcon.style.height = '100px';
            fileIcon.style.display = 'flex';
            fileIcon.style.alignItems = 'center';
            fileIcon.style.justifyContent = 'center';
            fileIcon.style.border = '1px solid #ccc';
            fileIcon.style.margin = '5px';
            fileIcon.style.position = 'relative';
            let iconImg = document.createElement('img');
            if (file.type === 'application/pdf') {
                iconImg.src = '{{ asset("img/pdf.png") }}';
            } else if (file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || file.type === 'application/msword') {
                iconImg.src = '{{ asset("img/word.png") }}';
            } else if (file.type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || file.type === 'application/vnd.ms-excel') {
                iconImg.src = '{{ asset("img/excel.jpg") }}';
            } else if (file.type === 'application/vnd.openxmlformats-officedocument.presentationml.presentation' || file.type === 'application/vnd.ms-powerpoint') {
                iconImg.src = '{{ asset("img/ppt.jpg") }}';
            } else {
                iconImg.src = '{{ asset("img/unknow.png") }}';
            }
            
            iconImg.style.width = '100px';
            iconImg.style.height = '100px';

            fileIcon.appendChild(iconImg);
            document.querySelector('.img-box').appendChild(fileIcon);
            checkFile();
        }
    }
}



function checkReset(){
    document.getElementById('btn-reset').addEventListener('click', function() {
    document.getElementById('fileInput').value = '';
    document.querySelector('.img-box').innerHTML = '';
    document.querySelector('.btn_close').innerHTML = '';
    checkFile();
});
}
const uploadFiles = async () => {
    const formData = new FormData();
    
    // Kiểm tra xem có tệp nào đã được chọn chưa
    if (selectedFiles.length === 0) {
        alert("Vui lòng chọn ít nhất một tệp để tải lên.");
        return;
    }

    selectedFiles.forEach(file => {
        formData.append('files[]', file);
    });

    try {
        const response = await axios.post('/store', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        alert(""Phản hồi từ server:", response.data");
        window.location.reload();  // Tải lại trang sau khi tải lên thành công
        console.log("Phản hồi từ server:", response.data);
    } catch (error) {
        alert("Tải lên thất bại! Vui lòng kiểm tra console để biết thêm chi tiết.");
        console.error("Lỗi tải lên:", error.response ? error.response.data : error.message);
    }
};


document.querySelector('.start_upload').addEventListener('click', function() {
    document.getElementById('fileInput').click();
    document.getElementById('fileInput').addEventListener('change', function() {
        console.log(this.files);
        
        handleFileUpload(this.files);
        toggleOffcanvas();
    });
});

    document.getElementById('dropdown1').addEventListener('click', function(e){
        e.preventDefault();

       let check =  document.querySelector('.none_display1');
         if(check.style.display === 'block'){
              check.style.display = 'none';
            }else{
                check.style.display = 'block';
            }
    });

    document.getElementById('dropdown2').addEventListener('click', function(e){
        e.preventDefault();

       let check =  document.querySelector('.show_language');
         if(check.style.display === 'grid'){
              check.style.display = 'none';
            }else{
                check.style.display = 'grid';
            }
    });
    let lastScrollTop = 0;
    const navbar = document.querySelector('.navbar');

    document.querySelector('.click_upload').addEventListener('click', function(e){
        e.preventDefault();
        document.getElementById('fileInput').click();
        document.getElementById('fileInput').addEventListener('change', function() {
            console.log(this.files);
            handleFileUpload(this.files);
        });
    });
    document.getElementById('close-button').addEventListener('click', function(e){
        e.preventDefault();
        checkReset();
        document.getElementById('offcanvas').classList.add('offcanvas-hidden');
        changeBackGround(false);
    });

    window.addEventListener("scroll", () => {
        let scrollTop = window.scrollY;

        if (scrollTop > lastScrollTop && scrollTop > navbar.offsetHeight) {
            navbar.classList.add('navbar-hidden');
        } else {

            navbar.classList.remove('navbar-hidden');
        }
        lastScrollTop = scrollTop;
    });
    function toggleOffcanvas() {
    const offcanvas = document.getElementById('offcanvas');
    const isHidden = offcanvas.classList.contains('offcanvas-hidden');
    if (isHidden) {
        offcanvas.classList.remove('offcanvas-hidden');
        changeBackGround(true);
     }
}

function changeBackGround(isCheck) {
    let color = document.querySelector('.bgr-blur');
    color.style.background = isCheck ? 'rgba(0, 0, 0, 0.5)' : 'rgba(0, 0, 0, 0)';
}
let isDragging = false;
window.addEventListener("dragenter", function (event) {
    event.preventDefault();
    if (!isDragging) {
        console.log("Đang kéo file vào trang...");
        toggleOffcanvas();
        isDragging = true;

    }
});
document.addEventListener('paste', (e)=>{
    e.preventDefault();
    const items = (e.clipboardData || e.originalEvent.clipboardData).items;
    const files = [];
    for (let index in items) {
        const item = items[index];
        if (item.kind === 'file') {
            const blob = item.getAsFile();
            files.push(blob);
        }
    }
    if(files.length > 0){
        handleFileUpload(files);
        toggleOffcanvas();
    }
});

dropZone.addEventListener("dragover", function (event) {
    event.preventDefault();
});

dropZone.addEventListener("drop", function (event) {
    event.preventDefault(); 
    console.log("File đã được thả vào trang");
    const files = event.dataTransfer.files;
    console.log(files);
    if(files.length > 0){
        handleFileUpload(files);
    }
});



</script>
</html>



{{-- 
back-end : cho phép uplaod các định dạng file khac img - done
back end đưa khối transaction đưa ra lỗi, vd 10 file ảnh, 1 file không phải ảnh -> thông báo lỗi
chuẩn hóa repository -done
login regisn qua email, gg,  -> done
check nếu login -> cho phép xem ảnh -> của user login(sửa, xóa, tạo album) -> done
không login -> chỉ xem ảnh -> done
--}}


