<<<<<<< HEAD
=======
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Tour</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: "Segoe UI", Arial, sans-serif; background: #eef2f7; }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #1e293b;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        }

        .sidebar h2 { font-size: 20px; text-align: center; margin-bottom: 25px; color: #38bdf8; font-weight: 600; }
        .sidebar a {
            padding: 14px 20px;
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: 0.25s;
            font-size: 15px;
        }
        .sidebar a:hover { background: #334155; color: #fff; }
        .sidebar i { margin-right: 12px; }

        /* CONTENT */
        .content { margin-left: 250px; padding: 40px 35px; }
        h1 { margin-bottom: 25px; font-size: 28px; font-weight: 600; color: #1e293b; }

        /* FORM */
        form { background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 950px; }

        /* GRID 2 CỘT */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
        label { font-weight: 600; margin-top: 12px; display: block; color: #334155; }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 15px;
            background: #f8fafc;
        }
        textarea { height: 110px; }
        .full-row { grid-column: span 2; }
=======
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            padding: 30px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 600px;
            margin: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277

        button {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background: #3498db;
            color: #fff;
            cursor: pointer;
        }
<<<<<<< HEAD
        button:hover { background: #2563eb; }
        a.back { display: inline-block; margin-top: 18px; color: #3b82f6; font-weight: 600; text-decoration: none; }
=======

        button:hover {
            background: #2980b9;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
        }
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
    </style>
</head>

<body>
<<<<<<< HEAD

    

    <!-- CONTENT -->
    <div class="content">
        <h1>Thêm Tour</h1>

        <form action="?action=tour_add_post" method="post" enctype="multipart/form-data">

            <div class="grid-2">

                <!-- CỘT TRÁI -->
                <div>
                    <label>Tên Tour</label>
                    <input type="text" name="ten_tour" required>

                    <label>Loại Tour</label>
                    <select name="loai_tour">
                        <option value="Trong nước">Trong nước</option>
                        <option value="Quốc tế">Quốc tế</option>
                        <option value="Theo yêu cầu">Theo yêu cầu</option>
                    </select>

                    <label>Giá</label>
                    <input type="number" name="gia">

                    <label>Mùa</label>
                    <select name="mua">
                        <option value="">Chọn Mùa</option>
                        <option value="Mùa Xuân">Mùa Xuân</option>
                        <option value="Mùa Hạ">Mùa Hạ</option>
                        <option value="Mùa Thu">Mùa Thu</option>
                        <option value="Mùa Đông">Mùa Đông</option>
                    </select>
                </div>

                <!-- CỘT PHẢI -->
                <div>
                    <label>Nhà Cung Cấp</label>
                    <select name="nha_cung_cap">
                        <option value="">Chọn Nhà Cung Cấp</option>
                        <option value="VietTravel">VietTravel</option>
                        <option value="Saigontourist">Saigontourist</option>
                        <option value="BestTrip">BestTrip</option>
                        <option value="Fiditour">Fiditour</option>
                        <option value="Khác">Khác</option>
                    </select>

                    <label>Hình ảnh đại diện</label>
                    <input type="file" name="hinh_anh">

                    <label>Album ảnh</label>
                    <input type="file" name="album[]" multiple>
                </div>

                <!-- FULL ROW MÔ TẢ -->
                <div class="full-row">
                    <label>Mô tả</label>
                    <textarea name="mo_ta"></textarea>
                </div>

                <!-- FULL ROW CHÍNH SÁCH -->
                <div class="full-row">
                    <label>Chính sách</label>
                    <textarea name="chinh_sach"></textarea>
                </div>

                <!-- FULL ROW LỊCH TRÌNH CHI TIẾT -->
                <div class="full-row">
                    <label>Lịch trình chi tiết</label>
                    <div id="itinerary-wrapper" style="background:#f8fafc;padding:12px;border-radius:8px;border:1px solid #e2e8f0;">
                        <div style="margin-bottom:8px;">
                            <button type="button" id="add-day"
                                style="background:#06b6d4;border:none;padding:8px 12px;color:#fff;border-radius:6px;cursor:pointer;">
                                Thêm ngày
                            </button>
                        </div>
                        <div id="days-list"></div>
                    </div>
                    <input type="hidden" name="lich_trinh" id="lich_trinh_input">
                    <small style="color:#6b7280;display:block;margin-top:6px;">
                        Tạo số ngày mong muốn, mỗi ngày có thể thêm nhiều mốc (thời gian, địa điểm, mô tả, ảnh). Dữ liệu lưu dưới dạng JSON; ảnh sẽ được upload và đường dẫn lưu trong JSON.
                    </small>
                </div>

            </div>

            <button type="submit">Thêm Tour</button>
            <a class="back" href="?action=tours">← Quay lại</a>
        </form>
    </div>

    <!-- SCRIPT JS QUẢN LÝ LỊCH TRÌNH -->
    <script>
        (function () {
            const daysList = document.getElementById('days-list');
            const addDayBtn = document.getElementById('add-day');
            const hidden = document.getElementById('lich_trinh_input');
            const form = document.querySelector('form[action="?action=tour_add_post"]');
=======
    <h1>Thêm Tour</h1>
    <form action="?action=tour_add_post" method="post" enctype="multipart/form-data">
        <label>Tên Tour</label>
        <input type="text" name="ten_tour" required>
        <label>Loại Tour</label>
        <select name="loai_tour">
            <option value="Trong nước">Trong nước</option>
            <option value="Quốc tế">Quốc tế</option>
            <option value="Yêu cầu">Yêu cầu</option>
        </select>
        <label>Mô tả</label>
        <textarea name="mo_ta"></textarea>
        <label>Giá</label>
        <input type="number" name="gia">
        <label>Chính sách</label>
        <textarea name="chinh_sach"></textarea>
        <label>Hình ảnh</label>
        <input type="file" name="hinh_anh">
         <hr>
    <h3>Nhà cung cấp</h3>
    <textarea name="nha_cung_cap"></textarea>
     <label>Mùa</label>
        <select name="mua">
            <option value="Mùa Xuân">Mùa Xuân</option>
            <option value="Mùa Hạ">Mùa Hạ</option>
            <option value="Mùa Thu">Mùa Thu</option>
            <option value="Mùa Đông">Mùa Đông</option>
        </select>
        <button type="submit">Thêm Tourr</button>
        <a href="?action=tours">Quay lại</a>
    </form>
</body>
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277

            function createSlot(slotData) {
                const slot = document.createElement('div');
                slot.className = 'slot';
                slot.style = 'border:1px dashed #e2e8f0;padding:10px;margin-bottom:8px;border-radius:6px;background:#fff;';
                slot.innerHTML = `
                    <label>Tiêu đề mốc</label>
                    <input type="text" class="it-title" value="${slotData.title || ''}" placeholder="VD: Tham quan Văn Miếu">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:8px;">
                        <div>
                            <label>Thời gian</label>
                            <input type="time" class="it-time" value="${slotData.time || ''}" placeholder="08:30">
                        </div>
                        <div>
                            <label>Địa điểm</label>
                            <input type="text" class="it-location" value="${slotData.location || ''}" placeholder="Hà Nội">
                        </div>
                    </div>
                    <label style="margin-top:8px;">Mô tả</label>
                    <textarea class="it-desc" placeholder="Mô tả chi tiết">${slotData.desc || ''}</textarea>
                    <label style="margin-top:8px;">Ảnh (tùy chọn)</label>
                    <input type="file" class="it-image">
                    <div style="text-align:right;margin-top:6px;">
                        <button type="button" class="remove-slot" style="background:#ef4444;border:none;color:#fff;padding:6px 10px;border-radius:6px;cursor:pointer;">Xóa mốc</button>
                    </div>
                `;
                slot.querySelector('.remove-slot').addEventListener('click', () => slot.remove());
                return slot;
            }

            function createDay(dayData) {
                const day = document.createElement('div');
                day.className = 'day';
                day.style = 'border:1px solid #e6edf0;padding:10px;margin-bottom:10px;border-radius:6px;background:#fff;';
                day.innerHTML = `
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <div style="flex:1;">
                            <label>Tiêu đề ngày</label>
                            <input type="text" class="day-title" value="${dayData.title || ''}" placeholder="VD: Ngày 1 - Hà Nội">
                        </div>
                        <div style="margin-left:12px;">
                            <button type="button" class="add-slot" style="background:#10b981;border:none;padding:8px 10px;color:#fff;border-radius:6px;cursor:pointer;">Thêm mốc</button>
                            <button type="button" class="remove-day" style="background:#ef4444;border:none;padding:8px 10px;color:#fff;border-radius:6px;cursor:pointer;margin-left:8px;">Xóa ngày</button>
                        </div>
                    </div>
                    <div class="slots" style="margin-top:10px;"></div>
                `;
                const slotsContainer = day.querySelector('.slots');
                day.querySelector('.add-slot').addEventListener('click', () => slotsContainer.appendChild(createSlot({})));
                day.querySelector('.remove-day').addEventListener('click', () => day.remove());
                if (Array.isArray(dayData.slots)) dayData.slots.forEach(s => slotsContainer.appendChild(createSlot(s)));
                return day;
            }

            addDayBtn.addEventListener('click', () => daysList.appendChild(createDay({})));
            daysList.appendChild(createDay({ title: 'Ngày 1', slots: [] }));

            if (form) {
                form.addEventListener('submit', function () {
                    document.querySelectorAll('#days-list .day').forEach((dayEl, dIdx) => {
                        dayEl.querySelectorAll('.slot').forEach((slotEl, sIdx) => {
                            const fileInput = slotEl.querySelector('.it-image');
                            if (fileInput) fileInput.name = `it_images[${dIdx}][${sIdx}]`;
                        });
                    });
                    const days = [];
                    document.querySelectorAll('#days-list .day').forEach((dayEl) => {
                        const dayTitle = dayEl.querySelector('.day-title').value.trim();
                        const slots = [];
                        dayEl.querySelectorAll('.slot').forEach(slotEl => {
                            const title = slotEl.querySelector('.it-title').value.trim();
                            const time = slotEl.querySelector('.it-time')?.value.trim() || '';
                            const location = slotEl.querySelector('.it-location')?.value.trim() || '';
                            const desc = slotEl.querySelector('.it-desc').value.trim();
                            slots.push({ title, time, location, desc });
                        });
                        days.push({ title: dayTitle, slots });
                    });
                    hidden.value = JSON.stringify(days);
                });
            }
        })();
    </script>

</body>
</html>
>>>>>>> lebang271206-ui
