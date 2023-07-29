<a href="{{ route('families.edit', $id) }}" class="text-warning me-2">
  <i class="fa-solid fa-pencil"></i>
</a>
<a href="javascript:void(0)" onclick="deleteFamily(`{{ route('families.destroy', $id) }}`)" class="text-danger">
  <i class="fa-solid fa-trash"></i>
</a>