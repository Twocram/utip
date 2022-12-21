<div class="modal-window__edit">
    <div class="modal-content">
        <button class="close-btn-edit">Close</button>
        <div class="modal-content__inputs">
            <input name="title-edit" type="text" placeholder="title">
            <input name="content-edit" type="text" placeholder="content">
            <select name="status-edit" id="select-status">
                <option selected value="1">Новый</option>
                <option value="2">В архиве</option>
            </select>
        </div>

        <div>
            <button onclick="updatePost()" class="create-btn">Edit</button>
        </div>

    </div>
</div>