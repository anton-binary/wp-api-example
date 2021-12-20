<?php

function tickStream_content() {
    $content = "";
    if(is_page('tick-stream')) {
        $content = <<<content
        <table>
            <tr>
                <td rowspan="2" style="padding: 5px; width: 70%; height: 150px">
                    <textarea id="output" style="width: 100%; height: 100%; border: none; resize: none" readonly></textarea>
                </td>
                <td style="text-align: center; height: 75px">
                    <span style="font-weight: bold" id="current_quote"></span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <span class="dynamicsparkline"></span>
                </td>
            </tr>
        </table>
        <div class="wp-block-buttons">
            <a class="wp-block-button__link" id="start" onclick="connect()">Start</a> 
            <a class="wp-block-button__link" id="stop" style="display: none" onclick="disconnect()">Stop</a> 
            <a class="wp-block-button__link" id="clear" style="display: none" onclick="clear_log()">Clear</a>
        </div>
        content;
    }
    return $content;
}

function tickStream_js_head() {
    if(is_page('tick-stream')) { 
    ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
        <script type="text/javascript">

            var ws = new WebSocket('wss://ws.binaryws.com/websockets/v3?app_id=1089');
            var chart_data = [];         

            function connect(button) {
                document.getElementById('start').style.display = 'none';
                document.getElementById('stop').style.display = 'inline';
                document.getElementById('clear').style.display = 'none';

                ws.send(JSON.stringify({ ticks: 'R_100' }));

                ws.onmessage = function (msg) {
                    var data = JSON.parse(msg.data);
                    if(data.msg_type == "tick") {
                        var date = new Date(data.tick.epoch * 1000);
                        var line = date.toISOString() + ": " + data.tick.quote + '\n';

                        if(chart_data.length == 20) chart_data.shift();
                        chart_data.push(data.tick.quote);
                        $('.dynamicsparkline').sparkline(chart_data,{ fillColor: 'white' });

                        document.getElementById('current_quote').innerHTML = data.tick.quote.toLocaleString(undefined,{ minimumFractionDigits: 2 });
                        document.getElementById('output').value = line + document.getElementById('output').value;
                    }
                };
            }

            function disconnect(button) {
                document.getElementById('start').style.display = 'inline';
                document.getElementById('stop').style.display = 'none';
                document.getElementById('clear').style.display = 'inline';
                ws.send(JSON.stringify({ forget_all: 'ticks' }));
            }

            function clear_log() {
                document.getElementById('output').value = "";
                document.getElementById('current_quote').innerHTML = ' ';
                $('.dynamicsparkline').sparkline([]);
                chart_data = [];
            }

        </script>
    <?php
    }
}