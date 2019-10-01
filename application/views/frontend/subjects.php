<?php echo $page[0]['page_content']; ?>
<script>
	$(document).ready(function() {
		$("a.intrest-btn").on("click", function() {
			var ref = $(this);
			var search_array = [
				// CHEMISTRY
				[0, 1, 2],
				[0, 4, 5],
				[6, 7, 8],
				[6, 10, 11],
				[12, 13, 14],
				[12, 16, 17],
				[12, 18, 19],
				[12, 20, 21],
				[12, 22, 23],
				[12, 24, 25],
				[26, 27, 28],
				[26, 30, 31],
				[26, 32, 33],
				[26, 34, 35],
				[26, 36, 37],
				[26, 38, 39],
				[26, 40, 41],
				[42, 43, 44],
				[42, 46, 47],
				[42, 48, 49],
				[42, 50, 51],
				[52, 53, 54],
				[52, 56, 57],
				[52, 58, 59],
				[52, 60, 61],
				[52, 62, 63],

				// PHYSICS
				[64, 65, 66],
				[64, 68, 69],
				[70, 71, 72],
				[70, 71, 72],
				[76, 77, 78],
				[76, 80, 81],
				[82, 83, 84],
				[82, 86, 87],
				[82, 88, 89],
				[90, 91, 92],
				[90, 94, 95],
				[96, 97, 98],
				[96, 100, 101],

				// MATH
				[102, 103, 104],
				[102, 103, 106],
				[107, 108, 109],
				[111, 112, 113],
				[115, 116, 117],
				[115, 116, 119],
				[120, 121, 122],
				[124, 125, 126],

				// BIOLOGY
				[128, 129, 130],
			];
			var array_values = [];
			var current_index = $("td").index($(ref).parent("td"));
			var my_values = [];
			
			$("td").each(function() {
				array_values.push(decodeHtml($(this).find("a").html()));
			});

			// GET INDEX OF
			// console.log($("td").index($(ref).parent("td")));
			z = 0;
			for(var i=0;i<search_array.length;i++)
			{
				for(var j=0;j<search_array[i].length;j++)
				{
					var value_at_position = search_array[i][j];
					var current_position = search_array[i].indexOf(search_array[i][j]);
					//console.log(current_position);
					if(value_at_position==current_index && z==0)
					{
						z = 1;
						for(var k=current_position;k>-1;k--)
						{
							var values_found = search_array[i][k];
							my_values.push(array_values[values_found]);
						}
					}
				}
				
			}
			//console.log(my_values);
			$("textarea#message").val('Hi, I\'m intrested in ' + my_values.reverse().join(', '));
		});

		function recursive(ref)
		{
			return decodeHtml(ref.html());
		}

		function decodeHtml(html) {
			var div = document.createElement("div");
			div.innerHTML = html;
			return div.innerText;
		}
	});
</script>
