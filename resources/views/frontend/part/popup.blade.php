<div class="popup popup-dk" id="register_popup">
    <div class="popup-content">
        <a href="javascript:void(0)" class="close-popup"  title="Đóng lại">X</a>
        <div class="title">CẬP NHẬT THÔNG TIN</div>
         {!! Form::open(array('url' => 'register', 'class' => 'dk-form', 'id' => 'register_form')) !!}
            <div class="form-row">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" placeholder="Tên đăng nhập">
            </div>
            <div class="form-row">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" placeholder="Mật khẩu">
            </div>
            <div class="form-row">
                <label for="gender">Giới tính</label>
                <select name="gender">
                    <option value="nam">Nam</option>
                    <option value="nu">Nữ</option>
                </select>
            </div>
            <div class="form-row">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" placeholder="Địa chỉ">
            </div>
            <div class="form-row">
                <label for="city">Thành phố</label>
                <input type="text" name="city" placeholder="Thành phố">
            </div>
            <div class="form-row">
                <label for="phonenumber">Điện thoại</label>
                <input type="text" name="phone" placeholder="Điện thoại">
            </div>
            <div class="form-row">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Email">
            </div>
            <div class="error" id="register_error" style="display:none">Bạn cần nhập đầy đủ các thông tin trên</div>
            <button class="btn-dk" id="register_button" type="button">Đăng kí</button>
            <div class="form-row">
               <a href="javascript:void(0)" class="forgot-pass" onclick="login();" title="Đăng nhập">Đăng nhập</a>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="popup popup-dn" id="login_popup">
    <div class="popup-content">
        <a href="javascript:void(0)" class="close-popup" title="Đóng lại">X</a>
        <div class="title">ĐĂNG NHẬP</div>

        {!! Form::open(array('url' => 'login', 'class' => 'dk-form', 'id' => 'login_form')) !!}
        <div class="form-row">
            <label for="username">Tên đăng nhập</label>
            <input type="text" name="username" placeholder="Tên đăng nhập">
        </div>
        <div class="form-row">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" placeholder="Mật khẩu">
        </div>

        <div class="error" id="login_error" style="display: none">Bạn cần nhập đầy đủ các thông tin trên</div>
        <div class="form-row tac">
            <button class="btn-dn" id="login_button">Đăng nhập</button>
            <a href="javascript:void(0)" class="forgot-pass" onclick="forgot();" title="Quên mật khẩu">Quên mật khẩu</a>
        </div>
        <div class="form-row">
            <p>Trở thành thành viên, Đăng kí ngay bây giờ để nhận được thông tin khuyến mại của chúng tôi.</p>
            <button class="btn-dk" type="button" onclick="register();">Đăng kí</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<div class="popup popup-dn forgot-dn" id="forgot_popup">
    <div class="popup-content">
        <a href="javascript:void(0)" class="close-popup" title="Đóng lại">X</a>
        <div class="title">QUÊN MẬT KHẨU</div>

        {!! Form::open(array('url' => 'forgot', 'class' => 'dk-form', 'id' => 'forgot_form')) !!}
        <div class="form-row">
            <label for="username">Tên đăng nhập</label>
            <input type="text" name="username" placeholder="Tên đăng nhập">
        </div>
        <div class="form-row">
            <label for="password">Mật khẩu mới</label>
            <input type="password" name="password" placeholder="Mật khẩu mới">
        </div>

        <div class="error" id="forgot_error" style="display: none">Bạn cần nhập đầy đủ các thông tin trên</div>
        <div class="form-row tac">
            <button class="btn-dn" id="forgot_button">Thay đổi</button>
            <a href="javascript:void(0)" class="forgot-pass" onclick="login();" title="Đăng nhập">Đăng nhập</a>
        </div>
        <div class="form-row">
            <p>Trở thành thành viên, Đăng kí ngay bây giờ để nhận được thông tin khuyến mại của chúng tôi.</p>
            <button class="btn-dk" type="button" onclick="register();">Đăng kí</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<div class='popup px' id="general_popup">
    <div class='popup-content'>
        <a href='javascript:void(0)' class='close-popup' title='Đóng lại'>X</a>
        <div class="title">THÔNG BÁO</div>
        <div class="error" id="general_error" style="display: none"></div>
        <div class="success" id="general_success" style="display: none"></div>
    </div>
</div>