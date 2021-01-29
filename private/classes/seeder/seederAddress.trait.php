<?php
    // ? Got addresses from https://www.randomlists.com/random-addresses?qty=500

    // seeder for addresses 
    trait SeederAddress {
        // to get a address
        public function address(string $type='full') {
            // get address
            if ($type === 'part') {
                $address = explode(",", $this->addresses[rand(0, count($this->addresses) - 1)]);
                $address = $address[0];
            } else {
                $address = $this->addresses[rand(0, count($this->addresses) - 1)];
            }
            // return data
            return $address; 
        }

        // an array of addresses, 500
        public $addresses = [
            '9879 West Temple Dr. Ridgewood, NJ 07450', '760 Monroe Lane Collierville, TN 38017', '51 E. Jackson St. Glen Cove, NY 11542', '51 Henry Lane Waldorf, MD 20601', '268 Myrtle Street Howard Beach, NY 11414', '177 Proctor Lane Henrico, VA 23228', '8949 E. Fremont Street North Olmsted, OH 44070', '70 Greenrose Street Chaska, MN 55318', '666 John Ave. Arlington Heights, IL 60004', '160 Cactus Dr. Zeeland, MI 49464', '8610 Courtland Ave. Summerville, SC 29483', '368 Linda St. Pawtucket, RI 02860', '406 3rd Court Akron, OH 44312', '8601 Magnolia Street Downingtown, PA 19335', '112 Prairie Drive Parlin, NJ 08859', '7 Washington Drive Fairburn, GA 30213', '446 Nut Swamp St. Stamford, CT 06902', '7269 Garfield St. Sterling, VA 20164', '7853 Lafayette Street Chicopee, MA 01020', '947 W. Ryan Street Pelham, AL 35124', '8638 Hawthorne St. Trenton, NJ 08610', '890 Alton St. North Canton, OH 44720', '836 Valley Street Winona, MN 55987', '8 South Heather Drive Owatonna, MN 55060', '9135 Big Rock Cove St. Ypsilanti, MI 48197', '7638 S. Big Rock Cove Lane Camas, WA 98607', '8402 Country Club St. Malvern, PA 19355', '990 College St. Hollis, NY 11423', '49 Bohemia St. Nashville, TN 37205', '52 S. Tunnel Lane Latrobe, PA 15650', '8006 Green Hill St. Harlingen, TX 78552', '994 Harrison Court Colorado Springs, CO 80911', '637 Laurel Ave. San Carlos, CA 94070', '74 Baker Rd. Cockeysville, MD 21030', '8046 Beaver Ridge Road Olive Branch, MS 38654', '86 Hill Field Street Amsterdam, NY 12010', '91 Princeton Street Lorton, VA 22079', '8998 Delaware St. West Hempstead, NY 11552', '26 Oakwood Street Lindenhurst, NY 11757', '8 Bank Road El Paso, TX 79930', '519 New Saddle Lane Bel Air, MD 21014', '81 Tunnel St. Bonita Springs, FL 34135', '8268 West Sunnyslope Rd. Wasilla, AK 99654', '9636 Sunbeam Avenue Neptune, NJ 07753', '9 Essex St. San Pablo, CA 94806', '8944 Temple Lane Lake Charles, LA 70605', '8226 Oakland Ave. Minneapolis, MN 55406', '7100 Colonial Street Vista, CA 92083', '924 Roosevelt Court Suite 561 Prior Lake, MN 55372', '447 Creek Street Niceville, FL 32578', '7642 Manhattan Ave. Cartersville, GA 30120', '516 Hillside St. Port Saint Lucie, FL 34952', '8967 Hall Dr. Glen Allen, VA 23059', '7179 Fulton St. New Lenox, IL 60451', '196 Queen Lane Ogden, UT 84404', '719 West Carson Drive Marshfield, WI 54449', '263 East Arch St. Battle Creek, MI 49015', '7420 William Avenue Asheville, NC 28803', '8258 6th Drive Marlborough, MA 01752', '56 Sulphur Springs Drive Hialeah, FL 33010', '98 Arcadia St. Ocean Springs, MS 39564', '918 Pin Oak Dr. Youngstown, OH 44512', '956 East Elm St. South Ozone Park, NY 11420', '67 Mountainview Ave. Tucker, GA 30084', '9069 West Harvey Street Dracut, MA 01826', '81 Central Street Garner, NC 27529', '53 North Saxon Ave. North Miami Beach, FL 33160', '54 Trusel Ave. Westminster, MD 21157', '4 Walnutwood Court Poughkeepsie, NY 12601', '163 Bridle Street Freehold, NJ 07728', '2 East College Court Rock Hill, SC 29730', '984B Euclid Dr. Cranston, RI 02920', '2 Wood St. Port Chester, NY 10573', '648 State Street Thornton, CO 80241', '70 Oakland St. Bethesda, MD 20814', '55 Sherman St. Ambler, PA 19002', '437 Wood Court Milton, MA 02186', '205 Eagle St. Gaithersburg, MD 20877', '8880 Pierce Street Lithonia, GA 30038', '80 Hanover Dr. Palm Bay, FL 32907', '645 W. Albany Street Norristown, PA 19401', '9828 Old York Dr. Scarsdale, NY 10583', '8975 Studebaker Street Hartford, CT 06106', '908 W. Clinton St. Monroeville, PA 15146', '93 Glenlake St. Corpus Christi, TX 78418', '99 North White Ave. Parkville, MD 21234', '59 Plumb Branch Lane West Palm Beach, FL 33404', '323 Sunset St. Loveland, OH 45140', '802 Fifth Street Cedar Falls, IA 50613', '90 Jones Dr. Wellington, FL 33414', '99 Johnson Rd. Thomasville, NC 27360', '9501 Arlington Ave. Omaha, NE 68107', '80 Brickyard Ave. New Baltimore, MI 48047', '8595 Oakland Court Sun City, AZ 85351', '9 E. Silver Spear Avenue Bensalem, PA 19020', '472 Mammoth Drive Alliance, OH 44601', '75 Sheffield Drive Jamaica Plain, MA 02130', '9509 Railroad Street Madison Heights, MI 48071', '23 Prospect Circle Stillwater, MN 55082', '324 North Fairfield St. Grand Blanc, MI 48439', '513 Heritage Court Dorchester Center, MA 02124', '8 Wild Rose Street Oklahoma City, OK 73112', '8754 Harvey St. Bartlett, IL 60103', '24 Bridge Street Capitol Heights, MD 20743', '71 North Lantern Ave. Wheaton, IL 60187', '63 St Louis Street Orlando, FL 32806', '606 Bear Hill Street Ottumwa, IA 52501', '287 Buttonwood Street Grosse Pointe, MI 48236', '977 San Pablo St. High Point, NC 27265', '980 Poor House Drive Irvington, NJ 07111', '2 S. Indian Summer Lane Erlanger, KY 41018', '499 New Saddle Street Glendora, CA 91740', '67 Clay St. Sanford, NC 27330', '93 Fordham Ave. Mishawaka, IN 46544', '208 Warren Ave. Fall River, MA 02720', '15 South Gartner Lane Hixson, TN 37343', '193 Cherry Street Bayonne, NJ 07002', '2 West Armstrong St. Monroe, NY 10950', '8056 East Broad St. Apopka, FL 32703', '743 S. Hanover Ave. Methuen, MA 01844', '39 North Center St. Sicklerville, NJ 08081', '594 Sierra Drive Ocoee, FL 34761', '204 E. Roberts St. Hanover Park, IL 60133', '18 Sussex Avenue Rochester, NY 14606', '70 Indian Spring Ave. Irwin, PA 15642', '21 Elmwood Avenue Holyoke, MA 01040', '51 Wild Horse Lane Fort Myers, FL 33905', '680 Fieldstone Lane Sarasota, FL 34231', '576 Studebaker Ave. Dubuque, IA 52001', '177 E. Valley Road West New York, NJ 07093', '180 Peachtree St. Des Moines, IA 50310', '8347 Ann Ave. Southgate, MI 48195', '481 Spring St. Springboro, OH 45066', '9738 Third St. Woburn, MA 01801', '47 Highland Dr. Gastonia, NC 28052', '30 Hill Drive Nottingham, MD 21236', '32 Peg Shop Road New Rochelle, NY 10801', '647 Bridle Rd. North Haven, CT 06473', '85 Carson Ave. Loxahatchee, FL 33470', '883 Arnold Dr. Avon Lake, OH 44012', '7872 Chestnut Rd. Oconomowoc, WI 53066', '7449 Bridgeton Street Indiana, PA 15701', '24 Hilltop Rd. Clermont, FL 34711', '747 South Rockwell Street Brownsburg, IN 46112', '689 West Plymouth Street Fresno, CA 93706', '880 Charles Street Park Ridge, IL 60068', '271 Pine Street Vineland, NJ 08360', '7490 South Arlington Street Canal Winchester, OH 43110', '8828 Valley View St. Rosemount, MN 55068', '881 Garfield Drive Fort Washington, MD 20744', '21 Penn Court Chatsworth, GA 30705', '9666 E. Woodside Ave. Mountain View, CA 94043', '96 W. Rock Creek Rd. Springfield Gardens, NY 11413', '897A Lees Creek Ave. Huntington Station, NY 11746', '8547 Winchester St. Monroe Township, NJ 08831', '56 Kirkland St. Yorktown Heights, NY 10598', '28 Border St. Metairie, LA 70001', '66 Market Ave. Tualatin, OR 97062', '744 West Amherst Court Port Charlotte, FL 33952', '739 Greenrose Drive San Jose, CA 95127', '494 Center Street Allentown, PA 18102', '36 East Harrison Ave. Huntersville, NC 28078', '10 S. Greystone Lane Tucson, AZ 85718', '112 Wilson Court Whitestone, NY 11357', '841 Brickell Street Lorain, OH 44052', '8164 University St. Florence, SC 29501', '151 Mulberry Lane Munster, IN 46321', '7282 Glenholme Court Shakopee, MN 55379', '800 Market St. Barrington, IL 60010', '655 Gonzales St. Allison Park, PA 15101', '59 Young Road Zionsville, IN 46077', '7366 State St. Germantown, MD 20874', '901 Helen St. Helotes, TX 78023', '9900 Cobblestone Dr. Saint Cloud, MN 56301', '8995 Jones Street Fullerton, CA 92831', '575 Hall Street Smithtown, NY 11787', '984 Washington St. Plainfield, NJ 07060', '805 West Willow Lane Marietta, GA 30008', '444 Rock Creek Street New Berlin, WI 53151', '183 Mill Lane Groton, CT 06340', '16 Atlantic Dr. Great Falls, MT 59404', '49 University St. Mc Lean, VA 22101', '470 SE. Meadowbrook Lane Waynesboro, PA 17268', '94 Academy Drive Berwyn, IL 60402', '9179 Rock Maple Drive Lincolnton, NC 28092', '8978 Third Ave. Port Richey, FL 34668', '1 Tailwater Drive Wilkes Barre, PA 18702', '633 Wellington St. Feasterville Trevose, PA 19053', '200 North Big Rock Cove Drive Windsor, CT 06095', '8430 Jockey Hollow Ave. Oak Park, MI 48237', '9698 Bowman St. Lawrence, MA 01841', '906 Manor Station Ave. Virginia Beach, VA 23451', '9899 Constitution Ave. Norwalk, CT 06851', '910 Maiden Road Starkville, MS 39759', '957 Fairfield Avenue Traverse City, MI 49684', '697 Third Street Reading, MA 01867', '585 Fifth St. New Hyde Park, NY 11040', '24 Poor House Ave. Roanoke Rapids, NC 27870', '8597 Ohio St. Inman, SC 29349', '51 Bowman St. Goose Creek, SC 29445', '7873 1st St. Evansville, IN 47711', '464 Rockland Lane Bowie, MD 20715', '183 Pacific Ave. Pottstown, PA 19464', '645 Ketch Harbour Drive Suwanee, GA 30024', '426 Wayne St. Winter Haven, FL 33880', '7574 Bowman Rd. Gibsonia, PA 15044', '7182 Baker Avenue Sunnyside, NY 11104', '8300 S. Belmont St. Saginaw, MI 48601', '891 Spruce Dr. Stafford, VA 22554', '88 Glenridge St. Orland Park, IL 60462', '8208 Brown Ave. Little Falls, NJ 07424', '24 Greenview Lane Chardon, OH 44024', '216 Clinton Dr. New Windsor, NY 12553', '82 Old Vermont Avenue Milledgeville, GA 31061', '8098 Carpenter Drive West Deptford, NJ 08096', '54 Monroe Lane Herndon, VA 20170', '688 Beech Street Orange, NJ 07050', '777 Rockwell Road North Fort Myers, FL 33917', '7122 Homewood Lane Holly Springs, NC 27540', '23 New Drive Oxnard, CA 93035', '102 North Mill Street Rockledge, FL 32955', '8677 Water St. Concord, NH 03301', '323 East Lincoln Court Chesterfield, VA 23832', '31 Ramblewood Street Coachella, CA 92236', '9380 Logan Ave. Noblesville, IN 46060', '7082 Windsor St. Wantagh, NY 11793', '49 Saxon Ave. Hernando, MS 38632', '38 Whitemarsh Rd. Freeport, NY 11520', '912 Princeton St. Prattville, AL 36067', '15 Albany Lane Spring Hill, FL 34608', '590 North Street Taylors, SC 29687', '136 Brook St. Warner Robins, GA 31088', '61 S. Redwood St. Canandaigua, NY 14424', '339 Water St. Saint Augustine, FL 32084', '62 Hamilton Ave. Muskegon, MI 49441', '51 Cypress St. Cedar Rapids, IA 52402', '230 Arcadia Dr. Oxford, MS 38655', '7963 Cedarwood Ave. Logansport, IN 46947', '3 Bellevue St. Astoria, NY 11102', '8865 SE. Strawberry St. Hummelstown, PA 17036', '62 W. Coffee Dr. Hilliard, OH 43026', '8392 East Aspen Dr. Uniontown, PA 15401', '476 Liberty Drive Faribault, MN 55021', '9339 Lees Creek Street Chandler, AZ 85224', '115 Mill St. Bristow, VA 20136', '9028 White St. Scotch Plains, NJ 07076', '955 Queen Dr. Liverpool, NY 13090', '96 Nut Swamp Drive Windermere, FL 34786', '209 Howard Avenue Quakertown, PA 18951', '105 Homestead Street Norman, OK 73072', '618 Oak Meadow Rd. Maumee, OH 43537', '8854 Fairfield Street Buffalo, NY 14215', '19 S. Sunnyslope Dr. Woonsocket, RI 02895', '213 Iroquois Ave. Harvey, IL 60426', '127 Linden Street Huntington, NY 11743', '75 Halifax Street Crofton, MD 21114', '28 Rockwell Dr. Yuma, AZ 85365', '70 Tarkiln Hill Dr. Ponte Vedra Beach, FL 32082', '9771 West New Saddle Avenue Lansdale, PA 19446', '996 Nut Swamp Circle Fort Worth, TX 76110', '7125 East Pleasant Rd. Lilburn, GA 30047', '7 Annadale Ave. Pueblo, CO 81001', '767 South Miller Street Andover, MA 01810', '9606 Middle River Ave. Cordova, TN 38016', '8067 Garden Ave. Shelbyville, TN 37160', '45 Woodland Ave. Schaumburg, IL 60193', '540 W. Harrison St. Pickerington, OH 43147', '960 S. Overlook St. Whitehall, PA 18052', '58 Mayfield St. New Kensington, PA 15068', '5 Country Ave. Ossining, NY 10562', '788 West Oak St. Morgantown, WV 26508', '9243 East Indian Summer Court Stuart, FL 34997', '867 Mulberry Ave. Waxhaw, NC 28173', '742 South Manchester Court Carlisle, PA 17013', '8418 1st St. Granger, IN 46530', '8407 Circle St. Douglasville, GA 30134', '82 Edgefield St. Dundalk, MD 21222', '900 Shipley Ave. Newnan, GA 30263', '579 Arnold Street Severn, MD 21144', '56 East Cedar St. Cantonment, FL 32533', '14 S. 2nd Rd. Knoxville, TN 37918', '8496 Foxrun Street Franklin Square, NY 11010', '445 Cedarwood St. Orchard Park, NY 14127', '2 Golf Dr. Bay Shore, NY 11706', '87 Glendale St. Eau Claire, WI 54701', '8987 Parker Road Jacksonville, NC 28540', '30 Brown Dr. Hobart, IN 46342', '734 NW. Greenview Court Anchorage, AK 99504', '41 Magnolia Circle Canonsburg, PA 15317', '5 Howard Street East Orange, NJ 07017', '4 Birchpond Court Fishers, IN 46037', '7649 Annadale Ave. Howell, NJ 07731', '7191 Meadow Court East Haven, CT 06512', '76 St Paul Drive Highland, IN 46322', '271 Howard Ave. Aiken, SC 29803', '9743 W. Mill St. Sevierville, TN 37876', '7898 Riverview St. Mobile, AL 36605', '884 Pennsylvania Dr. Ontario, CA 91762', '700 Country Club Street Bakersfield, CA 93306', '25 North Border Ave. Mason, OH 45040', '486 Fairview Ave. Westmont, IL 60559', '403 Pearl Dr. Onalaska, WI 54650', '40 West Shore St. Bristol, CT 06010', '9789 Mammoth Rd. Lincoln, NE 68506', '8620 Myers St. Snohomish, WA 98290', '879 Grove Rd. Hendersonville, NC 28792', '9994 Church Drive Quincy, MA 02169', '677 Van Dyke Drive Apt 1 Crawfordsville, IN 47933', '9 Sierra Street Xenia, OH 45385', '9641 West Second Lane Maineville, OH 45039', '8958 King Avenue Morganton, NC 28655', '440 Homestead Street Chicago, IL 60621', '79B Galvin St. Menasha, WI 54952', '119 Roehampton St. Newark, NJ 07103', '79 E. Bowman Street Fayetteville, NC 28303', '8214 Old Schoolhouse St. Naugatuck, CT 06770', '8224 Walt Whitman St. Hallandale, FL 33009', '9581 Locust Lane Powhatan, VA 23139', '30 Franklin Ave. Malden, MA 02148', '3 Sussex Street Mesa, AZ 85203', '49 Marconi Street Menomonee Falls, WI 53051', '769 E. Marsh Street Port Jefferson Station, NY 11776', '9214 Marconi St. Mankato, MN 56001', '19 N. Arrowhead Street Navarre, FL 32566', '7380 Walnutwood Dr. Rosedale, NY 11422', '27 Johnson Ave. Zanesville, OH 43701', '7955 Rockaway Ave. Reisterstown, MD 21136', '3 Walt Whitman St. Beachwood, OH 44122', '3 Trusel St. Savannah, GA 31404', '536 River Ave. Fairmont, WV 26554', '575 Windfall Ave. Stone Mountain, GA 30083', '716 Sage Drive Staunton, VA 24401', '689 Rockaway Ave. Portage, IN 46368', '8591 Taylor Dr. Londonderry, NH 03053', '226 Southampton Avenue Norwood, MA 02062', '624 Miller Drive Suffolk, VA 23434', '417 East Gregory Ave. Clarksburg, WV 26301', '327 Alton St. Hillsboro, OR 97124', '63 Manchester Dr. Camden, NJ 08105', '10 Yukon St. Green Cove Springs, FL 32043', '401 Harrison Lane Greer, SC 29650', '340 Philmont Ave. Glen Burnie, MD 21060', '9118 Sherwood St. Calumet City, IL 60409', '685 Atlantic Dr. La Vergne, TN 37086', '197 Court Drive East Stroudsburg, PA 18301', '40 Bayport Dr. Egg Harbor Township, NJ 08234', '71 Gregory St. Mount Pleasant, SC 29464', '98 Wall Drive Murrells Inlet, SC 29576', '7500 Winding Way St. Buford, GA 30518', '527 Spring Ave. Somerset, NJ 08873', '26 Boston Lane Elkridge, MD 21075', '372 Old Cleveland Ave. Shirley, NY 11967', '59 Del Monte Street Campbell, CA 95008', '9448 Hill Field Ave. Encino, CA 91316', '4 Linden Ave. Middle Village, NY 11379', '133 Lakeview Street Rocklin, CA 95677', '23 Mill Road Harrisburg, PA 17109', '974 Evergreen Drive West Lafayette, IN 47906', '9 Summit Street Dublin, GA 31021', '7052 West Pin Oak St. Fairfax, VA 22030', '374 Marshall Lane Anderson, SC 29621', '814 Grand St. Aliquippa, PA 15001', '9608 Pine Drive Princeton, NJ 08540', '726 Kirkland Circle Chesapeake, VA 23320', '737 Academy St. Saint Albans, NY 11412', '72 Fieldstone Court Middle River, MD 21220', '35 Sussex St. Jackson Heights, NY 11372', '81 Squaw Creek Road Joliet, IL 60435', '86 Orange Ave. Trussville, AL 35173', '66 Pierce Drive Lenoir, NC 28645', '70 Lees Creek St. Lacey, WA 98503', '684 Morris Drive Georgetown, SC 29440', '7954 Hawthorne Road Ridgefield, CT 06877', '489 Maiden St. Lagrange, GA 30240', '74 Railroad Street Pataskala, OH 43062', '7557 North Greenrose Ave. Jeffersonville, IN 47130', '8461 Old Glen Ridge Rd. Teaneck, NJ 07666', '76 Newcastle Street Oak Forest, IL 60452', '77 Goldfield Street Watertown, MA 02472', '508 8th St. Battle Ground, WA 98604', '394 Valley Farms St. Cocoa, FL 32927', '23 Country Club Ave. Auburn, NY 13021', '11 Cherry Hill St. Greenwood, SC 29646', '507 Wayne Street Carrollton, GA 30117', '6C West Plymouth St. Muskogee, OK 74403', '7737 Annadale Street Potomac, MD 20854', '14 SW. Wrangler Street Roswell, GA 30075', '446 Gregory Court Wake Forest, NC 27587', '524 Brandywine Ave. Peachtree City, GA 30269', '905 Rockcrest St. Elk River, MN 55330', '354 Elizabeth Road Glendale Heights, IL 60139', '64 Oak Valley Ave. Asbury Park, NJ 07712', '9433 Lantern Street Moncks Corner, SC 29461', '7969 E. Pumpkin Hill Dr. Roseville, MI 48066', '256 Fawn St. Holbrook, NY 11741', '82 Middle River St. Redford, MI 48239', '128 Longbranch Drive Key West, FL 33040', '8218 Paris Hill Lane Soddy Daisy, TN 37379', '461 Garden Road Appleton, WI 54911', '7911 Carson Avenue Shrewsbury, MA 01545', '615 Gainsway Dr. Cranford, NJ 07016', '7117 Rockwell Street Rowlett, TX 75088', '8016 Sunnyslope Court Graham, NC 27253', '1 Union Street Saint Louis, MO 63109', '71 Edgewater Avenue Dover, NH 03820', '487 Westport Ave. Paterson, NJ 07501', '8 Westminster Drive Woodhaven, NY 11421', '663 Miles Ave. Naples, FL 34116', '538 Creek Ave. Patchogue, NY 11772', '8084 Marconi Street Round Lake, IL 60073', '6 La Sierra Street Batavia, OH 45103', '32 Birchpond St. Winchester, VA 22601', '8600 Purple Finch Street Unit 60 Tampa, FL 33604', '52 S. Brickell Drive Palm Beach Gardens, FL 33410', '214 Carriage Dr. North Wales, PA 19454', '8249 Gartner St. Morristown, NJ 07960', '7834 North Victoria Lane Falls Church, VA 22041', '8709 E. Bradford Drive Hightstown, NJ 08520', '31 Littleton Dr. Minot, ND 58701', '573 Wayne St. Montgomery, AL 36109', '55 Sunbeam Court Santa Monica, CA 90403', '7609 E. Paris Hill Drive Blacksburg, VA 24060', '4 Ridgewood Ave. Bettendorf, IA 52722', '7155 West Armstrong Lane Lexington, NC 27292', '490 Deerfield St. Tallahassee, FL 32303', '9838 Shipley Dr. Tupelo, MS 38801', '7 San Carlos St. Upland, CA 91784', '747 Sunnyslope Ave. Lansdowne, PA 19050', '63 Somerset Street Derby, KS 67037', '21 Tunnel Lane Moorhead, MN 56560', '55 Glen Creek Court Seymour, IN 47274', '9884 Old Augusta Dr. Middletown, CT 06457', '105 Myrtle St. Huntsville, AL 35803', '8 Madison Lane Kennewick, WA 99337', '551 Pacific Dr. Williamstown, NJ 08094', '206 Edgemont Lane Natchez, MS 39120', '526 Mill St. Bardstown, KY 40004', '55 Lees Creek Drive Decatur, GA 30030', '31 Glenwood Street Largo, FL 33771', '8234 Saxon Street Clarkston, MI 48348', '3 Pennsylvania Ave. Frederick, MD 21701', '725 Walnutwood St. Hinesville, GA 31313', '60 St Louis Lane Bear, DE 19701', '68 South New St. Grovetown, GA 30813', '488 Anderson Lane Carmel, NY 10512', '8123 West Rd. Collegeville, PA 19426', '835 South Beechwood Ave. Cranberry Twp, PA 16066', '375 Gonzales Lane Billings, MT 59101', '63 La Sierra Dr. Janesville, WI 53546', '59 Orchard Drive New Brunswick, NJ 08901', '7906 Pennington St. Ottawa, IL 61350', '8247 Swanson St. Lanham, MD 20706', '551 Indian Spring Street Royersford, PA 19468', '8810 6th Ave. Evans, GA 30809', '424 Bridle Drive Boynton Beach, FL 33435', '9515 Applegate Avenue Syosset, NY 11791', '320 S. Locust St. Pleasanton, CA 94566', '7724 Old Eagle Ave. Hanover, PA 17331', '8285 Plymouth Dr. Clinton Township, MI 48035', '65 Broad Drive Bedford, OH 44146', '25 Edgemont Street Flowery Branch, GA 30542', '19 Sage Ave. Charleston, SC 29406', '754 Fairway Rd. Hillsborough, NJ 08844', '775 Andover Street Greenfield, IN 46140', '495 Wayne St. Fitchburg, MA 01420', '102 Newcastle Dr. The Villages, FL 32162', '645 Essex Drive West Islip, NY 11795', '816 Morris Drive Beaver Falls, PA 15010', '2 Logan St. Massapequa, NY 11758', '8601 Ocean St. Hudson, NH 03051', '655 Grand St. Seattle, WA 98144', '8917 Jennings Dr. East Meadow, NY 11554', '28 Bridgeton Rd. Stoughton, MA 02072', '638 N. Bayport Street Westlake, OH 44145', '8164 High Noon Street Dorchester, MA 02125', '9710 Tailwater Ave. Wausau, WI 54401', '98 Plymouth St. Mechanicsville, VA 23111', '232 W. 10th Road Lawndale, CA 90260', '38 Walt Whitman Dr. Fleming Island, FL 32003', '732 Glenridge St. Racine, WI 53402', '767 West Smoky Hollow Drive Waterford, MI 48329', '86 N. Thorne Road Bozeman, MT 59715', '92 South San Juan St. Rolla, MO 65401', '211 South Grand St. Providence, RI 02904', '8737 6th Dr. Hagerstown, MD 21740', '185 Fremont St. Gurnee, IL 60031', '645 Saxon St. Jamaica, NY 11432', '8539 N. Johnson St. Columbia, MD 21044', '5 Peachtree Lane Centreville, VA 20120', '42 Edgewater Ave. Warwick, RI 02886', '9419 Buckingham St. Yorktown, VA 23693', '105 N. Middle River Lane Temple Hills, MD 20748', '22 Oak Meadow Dr. Macon, GA 31204', '8544 Border Lane Marquette, MI 49855', '83 Country Club Street Westford, MA 01886', '19 Second Road Hyattsville, MD 20782', '8 County Street Westerville, OH 43081', '9270 Cross Drive Long Branch, NJ 07740', '16 Trusel St. Tiffin, OH 44883', '3 Berkshire Street Olney, MD 20832'
        ];    
    }
?>