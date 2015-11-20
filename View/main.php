<div class="jumbotron" xmlns="http://www.w3.org/1999/html">
        <h1>ImageFinder</h1>


        <form action="<?=MYSITE?>main/loadList" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <p>Please, chose parsing mode</p>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success active">
                        <input type="radio" name="classic" id="option1" autocomplete="off" checked> Classic mode
                    </label>
                    <label class="btn btn-success">
                        <input type="radio" name="api" id="option2" autocomplete="off"> Api mode
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="clear"/> Clear folder from old images?
                </label>
            </div>
            <blockquote>
                <p>Please, select the Excel file with a list of goods</p>
            </blockquote>
            <div class="form-group">
                <input class="form-control" type="file" name="prodList" id="inp"/>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-success form-control" type="submit">Upload</button>
            </div>
        </form>
    </div>

    <div class="row marketing">
    </div>

