@extends('front-end.masterpage.master')
@section('content')

    <main> 
       
       <div class="container">
                <section>
                    <h2> Danh Sách Các Hãng Bay</h2>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row alert" >
                                            <div class="col-sm-3">
                                                <label class="control-label"> Tên Hãng Bay</label>                                       
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Quốc gia</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label"></label>
                                        
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @foreach($sql as $row)
                    <article>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                 
                                        <h4><strong><a href="#"> 
                                        </a></strong></h4>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="control-label">{{ $row->airways_name }}</label>
                                           
                                                <div><big class="time"></big></div>
                                                <div><span class="place"> </span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">{{ $row->country_name }}</label>
                                                <div><big class="time"></big></div>

                                
                                                <div><span class="place"></span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label"></label>
                                                <div><big class="time">
                                        
                                                </big></div>
                                               
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    @endforeach
                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">&lsaquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">&rsaquo;</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </section>
            </div>
           
    </main>
  @endsection