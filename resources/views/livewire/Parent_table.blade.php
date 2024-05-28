<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showAddForm"
    type="button">{{ trans('Parent_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
        style="text-align: center">
        <thead>
            <tr class="table-success">
                <th>#</th>
                <th>{{ trans('Parent_trans.Email') }}</th>
                <th>{{ trans('Parent_trans.Name_Father') }}</th>
                <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
                <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                <th>{{ trans('Parent_trans.Job_Father') }}</th>
                <th>{{ trans('Parent_trans.Processes') }}</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($my_parents as $my_parent)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $my_parent->email }}</td>
                    <td>{{ $my_parent->name_father }}</td>
                    <td>{{ $my_parent->national_id_father }}</td>
                    <td>{{ $my_parent->passport_id_father }}</td>
                    <td>{{ $my_parent->phone_father }}</td>
                    <td>{{ $my_parent->job_father }}</td>
                    <td>
                        <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('Grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>

                        <button wire:click="confirmDelete({{ $my_parent->id }})"
                            title="{{ trans('Grades_trans.Delete') }}" class="btn btn-danger btn-sm"><i
                                class="fa fa-trash"></i></button>


                        @if ($showConfirmation)
                            <!-- نافذة تأكيد الحذف -->
                            <div class="modal fade show" id="confirmDeleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="confirmDeleteModalLabel" aria-hidden="true" style="display: block;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">تأكيد الحذف</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            هل أنت متأكد أنك تريد حذف هذا العنصر؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">إلغاء</button>
                                            <!-- زر الحذف بعد التأكيد -->
                                            <button type="button" wire:click="deleteParent"
                                                class="btn btn-danger">حذف</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </td>
                </tr>
            @endforeach
    </table>
</div>
<script>
    function confirmDelete(parentId) {
        // تخزين القيمة في متغير مؤقت
        window.parentIdToDelete = parentId;

        // عرض نافذة تأكيد الحذف
        $('#confirmDeleteModal').modal('show');
    }
</script>
