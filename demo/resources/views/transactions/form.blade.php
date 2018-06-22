{{ csrf_field() }}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Amount: (include negative number for debit)</strong>
            <input type="text" placeholder="Amount" name="amount" class = 'form-control'/>
        </div>
        <div class="form-group">
            <strong>Description</strong>
            <textarea placeholder="description" name="description" class = 'form-control'></textarea>

        </div>

        <div class="form-group">
            <strong>Transaction Date</strong>
            <input type="date" placeholder="Transaction Date" name="tranaction_date" class = 'form-control'/>
        </div>

        <div class="form-group">
            <strong>Chart:</strong>
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