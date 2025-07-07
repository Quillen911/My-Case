<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function showCheckboxes(checkboxClass, showBtnId, deleteBtnId, cancelBtnId) {
            var checkboxes = document.getElementsByClassName(checkboxClass);
            for (var i = 0; i < checkboxes.length ; i++) {
                checkboxes[i].style.display = 'inline';
            }
            document.getElementById(showBtnId).style.display = 'none';
            if(deleteBtnId) document.getElementById(deleteBtnId).style.display = 'inline';
            if(cancelBtnId) document.getElementById(cancelBtnId).style.display = 'inline';
        }
        function hideCheckboxes(checkboxClass, showBtnId, deleteBtnId, cancelBtnId) {
            var checkboxes = document.getElementsByClassName(checkboxClass);
            for (var i = 0; i < checkboxes.length ; i++) {
                checkboxes[i].checked = false;
                checkboxes[i].style.display = 'none';
            }
            document.getElementById(showBtnId).style.display = 'inline';
            if(deleteBtnId) document.getElementById(deleteBtnId).style.display = 'none';
            if(cancelBtnId) document.getElementById(cancelBtnId).style.display = 'none';
        }
    </script>
</head>
<body>
    @if(isset($error) && $error)
        <p style="color:red;">{{ $error }}</p>
    @endif
    @if(isset($success) && $success)
        <p style="color:green;">{{ $success }}</p>
    @endif
    <form action="{{ route('bulkDeleteUser') }}" method="POST" id="checkboxDelete">
        @csrf
        <h1>Kullanıcılar</h1>
        <table border="5" cellpadding="8" cellspacing="0" >
            <thead>
                <tr>
                    <th></th>
                    <th>Kullanıcı ID</th>
                    <th>Kullanıcı Adı</th>
                    <th>Kullanıcı Email</th>
                    <th>Düzenle</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $u)
                    <tr>
                        <td>
                            <input type="checkbox" class="note-checkbox" name="user_ids[]" value="{{$u->id}}" style="display:none; margin-right:8px;" >
                        </td>
                        <td> {{$u->id}} </td>
                        <td> {{$u->username}} </td>
                        <td> {{$u->email}} </td>
                        <td> <a href="{{route('editVerify', $u->id)}}" method="POST">Düzenle</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button id="show-checkbox-btn" type="button" onclick="showCheckboxes('note-checkbox', 'show-checkbox-btn', 'delete-selected-btn', 'action-back-btn');">Sil</button>
        <button id="delete-selected-btn" type="submit" style="display:none;">Seçilenleri Sil</button>
        <button id="action-back-btn" type="button" style="display:none" onclick="hideCheckboxes('note-checkbox', 'show-checkbox-btn', 'delete-selected-btn', 'action-back-btn');">Vazgeç</button>
    </form>
    
    <a href="{{ route('main') }}" class="back-btn">Geri Dön</a><br>
    <a href="{{ route('deleteListUser') }}" class="back-btn">Silinenler</a>
</body>
</html>