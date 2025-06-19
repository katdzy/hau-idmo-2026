<x-app-layout>
  <div class="container min-h-screen">
    <div class="add-box">
      <div class="ab-left">
        {{-- Cancel/Cancel Editing Button --}}
        <div class="cancel">
          <a href="{{ route('portal.certifications.view', ['id' => $data->id]) }}">
            <img src="{{ asset('images/icons/back.png') }}" alt="Back">
            @if($data->status != "To-review")
              <h1>Cancel Editing</h1>
            @else
              <h1>Cancel</h1>
            @endif
          </a>
        </div>

        <section class="reminder">
          @if($data->status != "To-review")  
            <h1>Filing Application</h1>
          @else
            <h1>Resubmit Application</h1>
          @endif
          <h3>Kindly double check the information before submitting.</h3>
        </section>
        <section class="logo">
          <img src="{{ asset('images/hau-logo.png') }}"/>
        </section>
      </div>
      <div class="ab-right pb-8">
        <section class="form-title">
          <h1>Certification Details</h1>
        </section>

        <section class="form-body">
          <form action="{{ route('portal.certifications.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row row1">
              <span>Certification Title <span class="font-bold text-red-500">*</span></span>
              <input type="text" name="cert_title" value="{{ $data->cert_title }}" required/>
            </div>

            <div class="flex flex-col">
              <span>Issued by <span class="font-bold text-red-500">*</span></span>
              <input type="text" name="issued_by" value="{{ $data->issued_by }}" required/>
            </div>

            <div class="form-row row2">
              <div class="form-col">
                <span>Date Issued <span class="font-bold text-red-500">*</span></span>
                <input type="date" name="date_issued" value="{{ $data->date_issued }}" min="1925-01-01" max="{{ date('Y-m-d') }}" required/>
              </div>

              <div class="form-col">
                <span>Validity <span class="font-bold text-red-500">*</span></span>
                <input type="date" name="cert_validity" value="{{ $data->cert_validity }}" required/>
              </div>

              <div class="form-col">
                <span>Duration <span class="font-bold text-red-500">*</span></span>
                <input type="text" name="duration" value="{{ $data->duration }}" required/>
              </div>
            </div>

            <div class="form-row row3">
              <div class="form-col">
                <span>Certification Type <span class="font-bold text-red-500">*</span></span>
                <input type="text" name="cert_type" style="width: 95%" value="{{ $data->cert_type }}" required/>
              </div>

              <div class="form-col">
                <span>Role <span class="font-bold text-red-500">*</span></span>
                <input type="text" name="role" style="width: 100%" value="{{ $data->role }}" required/>
              </div>
            </div>

            {{-- Attachment Row --}}
            <div class="form-row lastrow">
              <div class="w-2/3 flex flex-col leading-tight">
                <span class="text-gray-400">Attachment <span class="font-bold text-red-500">*</span></span>
                <div class="flex-col">
                  <div class="w-full flex items-center my-2" id="attachment">
                    <img src="{{ asset('images/icons/attachment.png') }}" alt="" class="w-[20px] h-[20px]">
                    <h1 class="truncate font-semibold text-gray-600">{{ $data->attachment }}</h1>
                    <button type="button" class="bg-gray-900 hover:bg-gray-800 text-white flex items-center px-8 py-1 ml-2 rounded-lg" id="edit_att">
                      <img src="{{ asset('images/icons/upload.png') }}" alt="" class="w-[20px] h-[20px]">
                      <span>Change File</span>
                    </button>
                  </div>
                </div>
                <div class="w-full flex gap-2 hide" id="attachment_edit">
                  <button type="button" class="bg-gray-900 hover:bg-gray-800 text-white flex items-center justify-center px-8 py-1 ml-2 rounded-lg" id="cancel">
                    <img src="{{ asset('images/icons/cancel.png') }}" alt="" class="w-[20px] h-[20px]">
                    <span>Cancel</span>
                  </button>
                  <input type="file" id="fileinput" name="attachment" class="text-gray-700 truncate">
                </div>
              </div>
            </div>

            {{-- Save Changes Button Row --}}
            <div class="form-row save-row">
              <div class="form-col form-row-submit">
                <button type="submit" class="btn-submit">Submit</button>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</x-app-layout>

<style>
.container {
  width: 100%;
  display: flex;
  justify-content: center;
  padding-top: 3rem;
}

.add-box {
  width: 85%;
  height: 550px;
  border-radius: 15px;
  background-color: white;
  display: grid;
  grid-template-columns: 40% 60%;
}

.ab-left, .ab-right {
  width: 100%;
  height: 100%;
}

.ab-left {
  display: grid;
  grid-template-rows: 15% 15% 70%;
}

.ab-left section {
  width: 100%;
  height: 100%;
}

/* Cancel Button Section (similar to edit_research) */
.cancel {
  display: flex;
  padding-left: 2rem;
  align-items: end;
}

.cancel a {
  background-color: maroon;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0.3rem 2rem;
  border-radius: 25px;
  transition: 300ms;
  text-decoration: none;
  height: 50%;
}

.cancel a:hover {
  background-color: #A84655;
}

.cancel a img {
  width: 15px;
  height: 15px;
  margin: 0 0.5rem;
}

.cancel a h1 {
  padding-right: 1rem;
  font-size: 1rem;
}

.reminder {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  line-height: 1.5rem;
  padding-top: 1rem;
}

.reminder h1 {
  font-size: 1.5rem;
  font-weight: bold;
}

.reminder h3 {
  font-size: 0.8rem;
}

.logo {
  display: flex;
  justify-content: center;
}

.logo img {
  width: 300px;
  height: 300px;
}

.ab-right {
  display: grid;
  grid-template-rows: 15% 75%;
  padding-left: 2rem;
}

.ab-right section {
  width: 100%;
  height: 100%;
}

.form-title {
  display: flex;
  align-items: end;
}

.form-title h1 {
  font-size: 1.7rem;
  font-weight: 900;
  color: rgba(0,0,0,0.7);
}

.form-body form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 2rem 1rem 0 0;
}

.form-row {
  width: 100%;
  display: flex;
  flex-direction: column;
  margin-bottom: 0.7rem;
}

.form-col {
  width: 100%;
}

.row1 input[type=text] {
  width: 100%;
}

.row2 input[type=text] {
  width: 100%;
}

.row2 input[type=date] {
  width: 95%;
}

.row2 {
  display: grid;
  grid-template-columns: 40% 40% 20%;
}

.row3 {
  display: grid;
  grid-template-columns: 50% 50%;
}

.ab-right input[type=text],
.ab-right input[type=date] {
  border: 1px solid rgba(0,0,0,0.2);
  border-radius: 10px;
  padding: 0.4rem;
}

.ab-right input[type=text]:focus,
.ab-right input[type=date]:focus {
  outline: none;
}

/* Attachment Section */
.lastrow {
  display: flex;
  flex-direction: column;
}

/* New save row for the button at bottom-right */
.save-row {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin-top: 1rem;
}

.form-row-submit {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: end;
}

.btn-submit {
  background-color: maroon;
  color: white;
  padding: 0.6rem 3rem;
  border-radius: 15px;
  transition: 300ms;
  border: none;
  cursor: pointer;
}

.btn-submit:hover {
  background-color: #A84655;
}

/* Utility class to hide elements */
.hide {
  display: none !important;
}
</style>

<script>
let attachment = document.getElementById('attachment'); 
let attachment_edit = document.getElementById('attachment_edit'); 

let attachment_btn = document.getElementById('edit_att'); 
let cancel_btn = document.getElementById('cancel');
 
attachment_btn.addEventListener("click", () => { 
  attachment_edit.classList.remove('hide'); 
  attachment.classList.add('hide'); 
  document.getElementById('fileinput').setAttribute('required', 'required');
});

cancel_btn.addEventListener('click', () => { 
  attachment_edit.classList.add('hide'); 
  // Clear the file input value
  const fileinput = document.getElementById('fileinput');
  fileinput.value = '';
  fileinput.removeAttribute('required');
  attachment.classList.remove('hide'); 
});
</script>
