{{ csrf_field() }}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" placeholder="Name" name="name" class = 'form-control'/>
        </div>
        <div class="form-group">
            <strong>Type:</strong>
            <select name="type"  class = 'form-control'>
                <option value="Bar">Bar</option>
                <option value="Line">Line</option>
            </select>

        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>