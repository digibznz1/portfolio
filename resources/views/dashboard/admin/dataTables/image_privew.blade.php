  <style type="text/css">
    .image-uploader {
      width: 100%;
      /*margin-bottom: 1.5rem;*/
    }

    .image-uploader label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 8px;
    }

    .image-uploader .wrapper {
      position: relative;
      height: 320px;
      width: 100%;
      border-radius: 16px;
      background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
      border: 2px dashed #d1d5db;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      cursor: pointer;
    }

    .image-uploader .wrapper:hover {
      border-color: #6366f1;
      background: linear-gradient(135deg, #fefefe 0%, #f9fafb 100%);
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(99, 102, 241, 0.1);
    }

    .image-uploader .wrapper.active {
      border-style: solid;
      border-color: #6366f1;
      background: #fff;
      box-shadow: 0 4px 20px rgba(99, 102, 241, 0.15);
    }

    /* ✅ إصلاح مشكلة الصورة */
    .image-uploader .image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: none;
    }

    .image-uploader .wrapper.active .image {
      display: block;
    }

    .image-uploader img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .image-uploader .wrapper.active:hover img {
      transform: scale(1.02);
    }

    /* ✅ إخفاء المحتوى عند وجود صورة */
    .image-uploader .wrapper.active .content {
      display: none;
    }

    .image-uploader .content {
      text-align: center;
      pointer-events: none;
      padding: 20px;
    }

    .image-uploader .icon {
      margin-bottom: 16px;
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    .image-uploader .icon i {
      font-size: 72px;
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      filter: drop-shadow(0 4px 8px rgba(99, 102, 241, 0.2));
    }

    .image-uploader .text {
      font-size: 15px;
      color: #6b7280;
      font-weight: 500;
      margin-bottom: 8px;
    }

    .image-uploader .file-name {
      font-size: 13px;
      color: #9ca3af;
      margin-top: 8px;
      font-weight: 400;
    }

    /* ✅ إصلاح زر الإلغاء */
    .image-uploader .cancel-btn {
      position: absolute;
      top: 16px;
      right: 16px;
      z-index: 100;
      display: none;
    }

    .image-uploader .wrapper.active .cancel-btn {
      display: block;
    }

    .image-uploader .cancel-btn i {
      background: linear-gradient(135deg, rgba(239, 68, 68, 0.95) 0%, rgba(220, 38, 38, 0.95) 100%);
      color: #fff;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      line-height: 36px;
      text-align: center;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
      display: block;
      pointer-events: auto;
    }

    .image-uploader .cancel-btn i:hover {
      transform: rotate(90deg) scale(1.1);
      box-shadow: 0 6px 16px rgba(239, 68, 68, 0.5);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .image-uploader .wrapper.active .cancel-btn {
      animation: fadeIn 0.3s ease;
    }

    .image-uploader .custom-btn {
      margin-top: 16px;
      width: 100%;
      padding: 14px 24px;
      border-radius: 12px;
      background: linear-gradient(135deg, #007d71 0%, #009688 100%);
      color: #fff;
      border: none;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
      position: relative;
      overflow: hidden;
    }

    .image-uploader .custom-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s;
    }

    .image-uploader .custom-btn:hover::before {
      left: 100%;
    }

    .image-uploader .custom-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    }

    .image-uploader .custom-btn:active {
      transform: translateY(0);
      box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
    }

    .text-danger {
      color: #ef4444;
    }

    .image-uploader .wrapper.dragover {
      border-color: #6366f1;
      background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
      transform: scale(1.02);
    }
  </style>

  <div class="container image-uploader">
    <h6 class="text-muted mb-2 text-green">
    المقاس المطلوب: width {{ !empty($width) ? $width : '' }}px × height {{ !empty($height) ? $height : '' }} px  
    {{--<small>(النسبة {{ $width }}:{{ $height }})</small>--}}
  </h6>

  <label>{{ trans($label) }} @if(!empty($required))<span class="text-danger">*</span>@endif</label>
  @error($name)
   <span class="invalid-feedback" role="alert" style="display:block;">
     <strong>{{ $message }}</strong>
   </span>
   @enderror
  <div class="wrapper">

    <div class="image">
      <img src="{{ $imagepath ?? '' }}" alt="">
    </div>

    <div class="content">
      <div class="icon">
        <i class="fas fa-cloud-upload-alt"></i>
      </div>
      <div class="text">اسحب الصورة هنا أو اضغط للاختيار</div>
      <div class="file-name"></div>
    </div>

    <div class="cancel-btn">
      <i class="fas fa-times"></i>
    </div>
  </div>

  <button type="button" class="custom-btn">
    <i class="fas fa-image"></i> اختر صورة
  </button>
  <input type="file" hidden name="{{ $name }}" class="default-btn" accept="image/*">
</div>
<script>
document.querySelectorAll('.image-uploader').forEach(uploader => {

    const wrapper   = uploader.querySelector('.wrapper');
    const input     = uploader.querySelector('.default-btn');
    const button    = uploader.querySelector('.custom-btn');
    const img       = uploader.querySelector('img');
    const fileName  = uploader.querySelector('.file-name');
    const cancelBtn = uploader.querySelector('.cancel-btn');

    const fieldName = input.getAttribute('name'); // اسم الحقل ديناميكياً

    // ✅ التحقق من وجود صورة عند تحميل الصفحة
    function checkExistingImage() {
        if (img.src && img.src !== '' && img.src !== window.location.href) {
            wrapper.classList.add('active');
            const urlParts = img.src.split('/');
            fileName.textContent = urlParts[urlParts.length - 1];
        }
    }

    checkExistingImage();

    // زر اختيار صورة
    button.onclick = () => input.click();

    // الضغط على المنطقة
    wrapper.onclick = (e) => {
        if (!cancelBtn.contains(e.target)) {
            input.click();
        }
    };

    // عند اختيار ملف
    input.onchange = () => {
        const file = input.files[0];
        if (!file) return;

        // 🔥 حذف cancel input إذا موجود
        const cancelInput = uploader.querySelector('.cancel-input');
        if (cancelInput) cancelInput.remove();

        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            wrapper.classList.add('active');
            fileName.textContent = file.name;
        };
        reader.readAsDataURL(file);
    };

    // ✅ زر الإلغاء
    cancelBtn.onclick = (e) => {
        e.stopPropagation();

        img.src = '';
        input.value = '';
        wrapper.classList.remove('active');
        fileName.textContent = '';

        // 🔥 إضافة input مخفي للإلغاء
        let cancelInput = uploader.querySelector('.cancel-input');

        if (!cancelInput) {
            cancelInput = document.createElement('input');
            cancelInput.type = 'hidden';
            cancelInput.name = fieldName;
            cancelInput.value = '0';
            cancelInput.classList.add('cancel-input');
            uploader.appendChild(cancelInput);
        } else {
            cancelInput.value = '1';
        }
    };

    // دعم السحب
    wrapper.addEventListener('dragover', (e) => {
        e.preventDefault();
        wrapper.classList.add('dragover');
    });

    wrapper.addEventListener('dragleave', () => {
        wrapper.classList.remove('dragover');
    });

    wrapper.addEventListener('drop', (e) => {
        e.preventDefault();
        wrapper.classList.remove('dragover');

        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {

            // 🔥 حذف cancel input إذا موجود
            const cancelInput = uploader.querySelector('.cancel-input');
            if (cancelInput) cancelInput.remove();

            input.files = e.dataTransfer.files;

            const reader = new FileReader();
            reader.onload = ev => {
                img.src = ev.target.result;
                wrapper.classList.add('active');
                fileName.textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    });

});
</script>