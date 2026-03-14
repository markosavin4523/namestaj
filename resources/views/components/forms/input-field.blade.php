@props(['type'=>'text', 'name','placeholder'])
<input type="{{ $type }}" name="{{ $name  }}" id="" class="form-control form-input" placeholder="{{ $placeholder }}"
       value="{{ old($name)  }}">
<x-forms.error-message :name="$name"/>
