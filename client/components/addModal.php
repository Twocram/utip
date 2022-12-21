<div class="modal-window">
    <div class="modal-content">
        <button class="close-btn">Close</button>
        <div class="modal-content__inputs">
            <input name="title" type="text" placeholder="title">
            <input name="content" type="text" placeholder="content">
            <select name="status" id="select-status">
                <option selected value="1">Новый</option>
                <option value="2">В архиве</option>
            </select>
        </div>

        <div>
            <button onclick="createPost(<?php echo $_SESSION['auth']['user']['id'] ?>)" class="create-btn">Create</button>
        </div>

    </div>
</div>