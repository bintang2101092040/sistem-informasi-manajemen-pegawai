<ul class="action-button-list">
    <li>
        @if ($dataizin->status_izin == 'i')
            <a href="/izinabsen/{{ $dataizin->izin_id }}/edit" class="btn btn-list text-primary">
                <span style="font-size: 20px">
                    <ion-icon name="create-outline"></ion-icon>
                    Edit Absen
                </span>
            </a>
        @elseif ($dataizin->status_izin == 's')
            <a href="/izinsakit/{{ $dataizin->izin_id }}/edit" class="btn btn-list text-primary">
                <span style="font-size: 20px">
                    <ion-icon name="create-outline"></ion-icon>
                    Edit Sakit
                </span>
            </a>
        @elseif ($dataizin->status_izin == 'c')
            <a href="/izincuti/{{ $dataizin->izin_id }}/edit" class="btn btn-list text-primary">
                <span style="font-size: 20px">
                    <ion-icon name="create-outline"></ion-icon>
                    Edit Cuti
                </span>
            </a>
        @endif
    </li>
    <li>
        <a href="#" id="deletebutton" class="btn btn-list text-danger" data-dismiss="modal" data-toggle="modal"
            data-target="#deleteConfirm">
            <span style="font-size: 20px">
                <ion-icon name="trash-outline"></ion-icon>
                Delete
            </span>
        </a>
    </li>
</ul>


<script>
    $(function() {
        $("#deletebutton").click(function(e) {
            $("#hapuspengajuan").attr("href", "/izin/" + "{{ $dataizin->izin_id }}/delete")
        });
    });
</script>
