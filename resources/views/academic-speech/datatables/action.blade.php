<a href="{{ route('academic-speech.edit', $id) }}" class="btn btn-primary" title="編輯">
    <i class="fa fa-edit" aria-hidden="true"></i>
</a>
{!! Form::open(['route' => ['academic-speech.destroy', $id], 'style' => 'display: inline', 'method' => 'DELETE', 'onSubmit' => "return confirm('確定要刪除嗎？');"]) !!}
<button type="submit" class="btn btn-danger" title="刪除">
    <i class="fa fa-times" aria-hidden="true"></i>
</button>
{!! Form::close() !!}
