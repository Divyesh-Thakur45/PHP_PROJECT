<?php
session_start();

// Initialize filter variables
$productFilter = isset($_GET['frame']) ? $_GET['frame'] : null;
$brand = isset($_GET['brand']) ? $_GET['brand'] : null;
$price = isset($_GET['price']) ? $_GET['price'] : null;
$gender = isset($_GET['gender']) ? $_GET['gender'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$searchData = isset($_GET['search']) ? $_GET['search'] : null;
$limit = 6;

// Mock data - replace with actual API call or database query
function fetchGogglesData($page, $limit, $productFilter, $brand, $gender, $price, $searchData)
{
    // Sample product data
    $products = [
        [
            'id' => 1,
            'imageUrl' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//v/i/vincent-chase-vc-e13469-c3-eyeglasses_g_0339_02_02_22.jpg',
            'imageUrl2' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//v/i/vincent-chase-vc-e13469-c3-eyeglasses_g_0339_1_02_02_22.jpg',
            'rating' => '4.5',
            'reviews' => '(1,234)',
            'brand' => 'Vincent Chase',
            'sizeCollection' => 'Size: Medium',
            'price' => '1,500',
            'discount' => '+2',
            'frame' => 'FullRim',
            'gender' => 'Mans'
        ],
        [
            'id' => 2,
            'imageUrl' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//j/o/john-jacobs-jj-e13958-c1-eyeglasses_g_4671_02_02_22.jpg',
            'imageUrl2' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//j/o/john-jacobs-jj-e13958-c1-eyeglasses_g_4671_1_02_02_22.jpg',
            'rating' => '4.2',
            'reviews' => '(856)',
            'brand' => 'John Jacobs',
            'sizeCollection' => 'Size: Large',
            'price' => '2,200',
            'discount' => '+3',
            'frame' => 'HalfRim',
            'gender' => 'Females'
        ],
        [
            'id' => 3,
            'imageUrl' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//l/e/lenskart-air-la-e13963-c2-eyeglasses_g_4676_02_02_22.jpg',
            'imageUrl2' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//l/e/lenskart-air-la-e13963-c2-eyeglasses_g_4676_1_02_02_22.jpg',
            'rating' => '4.7',
            'reviews' => '(2,145)',
            'brand' => 'Lenskart Air',
            'sizeCollection' => 'Size: Small',
            'price' => '1,800',
            'discount' => '+4',
            'frame' => 'Rectangle',
            'gender' => 'Kids'
        ],
        [
            'id' => 4,
            'imageUrl' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//v/i/vincent-chase-vc-e13470-c1-eyeglasses_g_0340_02_02_22.jpg',
            'imageUrl2' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//v/i/vincent-chase-vc-e13470-c1-eyeglasses_g_0340_1_02_02_22.jpg',
            'rating' => '4.3',
            'reviews' => '(967)',
            'brand' => 'Vincent Chase',
            'sizeCollection' => 'Size: Medium',
            'price' => '1,650',
            'discount' => '+2',
            'frame' => 'Square',
            'gender' => 'Mans'
        ],
        [
            'id' => 5,
            'imageUrl' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//j/o/john-jacobs-jj-e13959-c2-eyeglasses_g_4672_02_02_22.jpg',
            'imageUrl2' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//j/o/john-jacobs-jj-e13959-c2-eyeglasses_g_4672_1_02_02_22.jpg',
            'rating' => '4.6',
            'reviews' => '(1,543)',
            'brand' => 'John Jacobs',
            'sizeCollection' => 'Size: Large',
            'price' => '2,100',
            'discount' => '+5',
            'frame' => 'Round',
            'gender' => 'Females'
        ],
        [
            'id' => 6,
            'imageUrl' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//l/e/lenskart-air-la-e13964-c1-eyeglasses_g_4677_02_02_22.jpg',
            'imageUrl2' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//l/e/lenskart-air-la-e13964-c1-eyeglasses_g_4677_1_02_02_22.jpg',
            'rating' => '4.4',
            'reviews' => '(1,876)',
            'brand' => 'Lenskart Air',
            'sizeCollection' => 'Size: Medium',
            'price' => '1,950',
            'discount' => '+3',
            'frame' => 'CatEye',
            'gender' => 'Kids'
        ]
    ];

    // Filter products based on criteria
    $filteredProducts = array_filter($products, function ($product) use ($productFilter, $brand, $gender, $searchData) {
        $matches = true;

        if ($productFilter && $product['frame'] !== $productFilter) {
            $matches = false;
        }

        if ($brand && $product['brand'] !== $brand) {
            $matches = false;
        }

        if ($gender && $product['gender'] !== $gender) {
            $matches = false;
        }

        if ($searchData && stripos($product['brand'], $searchData) === false) {
            $matches = false;
        }

        return $matches;
    });

    // Sort by price if specified
    if ($price) {
        usort($filteredProducts, function ($a, $b) use ($price) {
            $priceA = (int)str_replace(',', '', $a['price']);
            $priceB = (int)str_replace(',', '', $b['price']);

            if ($price === 'asc') {
                return $priceA - $priceB;
            } else {
                return $priceB - $priceA;
            }
        });
    }

    $totalCount = count($filteredProducts);
    $offset = ($page - 1) * $limit;
    $paginatedProducts = array_slice($filteredProducts, $offset, $limit);

    return [
        'products' => $paginatedProducts,
        'totalCount' => $totalCount
    ];
}

$result = fetchGogglesData($page, $limit, $productFilter, $brand, $gender, $price, $searchData);
$gogglesData = $result['products'];
$totalCount = $result['totalCount'];
$totalPages = ceil($totalCount / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eyeglasses - Lenskart</title>
    <link rel="stylesheet" href="../assets/css/eyeglasses.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div>
        <img src="https://static5.lenskart.com/media/uploads/plp-free-lenses-desk.png" alt="Free Lenses Banner" style="width: 100%; height: auto;">

        <div class="ShowBtn">
            <i class="fas fa-bars" id="openFilter" onclick="toggleFilter()"></i>
            <i class="fas fa-times-circle" id="closeFilter" onclick="toggleFilter()" style="display: none;"></i>
        </div>

        <div class="EyeGlassesSection">
            <div class="EyeGlassesSection-Left" id="filterSection">
                <div class="filter-section">
                    <form method="GET" action="" id="filterForm">
                        <input type="hidden" name="page" value="1">
                        <?php if ($searchData): ?>
                            <input type="hidden" name="search" value="<?php echo htmlspecialchars($searchData); ?>">
                        <?php endif; ?>

                        <div class="filter-group">
                            <h3>AGE GROUP</h3>
                            <label>
                                <input type="radio" name="frame" value="Aviator" <?php echo $productFilter === 'Aviator' ? 'checked' : ''; ?> onchange="submitFilter()">
                                2-5 yrs(21)
                            </label>
                            <label>
                                <input type="radio" name="frame" value="HalfRim" <?php echo $productFilter === 'HalfRim' ? 'checked' : ''; ?> onchange="submitFilter()">
                                5-8 yrs(40)
                            </label>
                            <label>
                                <input type="radio" name="frame" value="FullRim" <?php echo $productFilter === 'FullRim' ? 'checked' : ''; ?> onchange="submitFilter()">
                                8-12 yrs(53)
                            </label>
                        </div>

                        <div class="filter-group">
                            <h3>FRAME TYPE</h3>
                            <div class="frame-options">
                                <div class="frame-option" onclick="setFrameFilter('FullRim')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/FullRim.png" alt="Full Rim">
                                    <p>Full Rim</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('RimLess')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Rimless.png" alt="Rimless">
                                    <p>Rimless</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('HalfRim')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/HalfRim.png" alt="Half Rim">
                                    <p>Half Rim</p>
                                </div>
                            </div>
                        </div>

                        <div class="filter-group">
                            <h3>FRAME SHAPE</h3>
                            <div class="frame-options">
                                <div class="frame-option" onclick="setFrameFilter('Rectangle')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Rectangle.png" alt="Rectangle">
                                    <p>Rectangle</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('Square')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Square.png" alt="Square">
                                    <p>Square</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('Round')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Round.png" alt="Round">
                                    <p>Round</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('CatEye')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/CatEye.png" alt="Cat Eye">
                                    <p>Cat Eye</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('Geometric')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Geometric.png" alt="Geometric">
                                    <p>Geometric</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('Aviator')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Aviator.png" alt="Aviator">
                                    <p>Aviator</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('Wayfarer')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Wayfarer.png" alt="Wayfarer">
                                    <p>Wayfarer</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('Hexagonal')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Hexagonal.png" alt="Hexagonal">
                                    <p>Hexagonal</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('Oval')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Oval.png" alt="Oval">
                                    <p>Oval</p>
                                </div>
                                <div class="frame-option" onclick="setFrameFilter('Clubmaster')">
                                    <img src="https://static.lenskart.com/images/cust_mailer/Eyeglass/Clubmaster.png" alt="Clubmaster">
                                    <p>Clubmaster</p>
                                </div>
                            </div>
                        </div>

                        <div class="filter-menu">
                            <select class="filter-item" name="brand" onchange="submitFilter()">
                                <option value="">BRANDS</option>
                                <option value="John Jacobs" <?php echo $brand === 'John Jacobs' ? 'selected' : ''; ?>>John Jacobs(841)</option>
                                <option value="Lenskart Air" <?php echo $brand === 'Lenskart Air' ? 'selected' : ''; ?>>Lenskart Air(516)</option>
                                <option value="Vincent Chase" <?php echo $brand === 'Vincent Chase' ? 'selected' : ''; ?>>Vincent Chase(501)</option>
                            </select>

                            <select class="filter-item">
                                <option>FRAME SIZE</option>
                                <option value="1">Extra Narrow(123)</option>
                                <option value="2">Narrow(524)</option>
                                <option value="3">Extra Wide(244)</option>
                            </select>

                            <select class="filter-item" name="price" onchange="submitFilter()">
                                <option value="">PRICE</option>
                                <option value="asc" <?php echo $price === 'asc' ? 'selected' : ''; ?>>Low To High</option>
                                <option value="desc" <?php echo $price === 'desc' ? 'selected' : ''; ?>>High To Low</option>
                            </select>

                            <select class="filter-item" name="gender" onchange="submitFilter()">
                                <option value="">GENDER</option>
                                <option value="Kids" <?php echo $gender === 'Kids' ? 'selected' : ''; ?>>Kids</option>
                                <option value="Mans" <?php echo $gender === 'Mans' ? 'selected' : ''; ?>>Mans</option>
                                <option value="Females" <?php echo $gender === 'Females' ? 'selected' : ''; ?>>Females</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="EyeGlassesSection-Right">
                <?php foreach ($gogglesData as $product): ?>
                    <div class="card">
                        <div class="card-header">
                            <i class="far fa-heart HeartIcon"></i>
                            <a href="product-details.php?id=<?php echo $product['id']; ?>">
                                <img src="<?php echo $product['imageUrl']; ?>" alt="<?php echo $product['brand']; ?>" class="product-image1">
                                <img src="<?php echo $product['imageUrl2']; ?>" alt="<?php echo $product['brand']; ?>" class="product-image2">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="rating">
                                <span class="rating-value"><?php echo $product['rating']; ?></span>
                                <span class="rating-count"><?php echo $product['reviews']; ?></span>
                            </div>
                            <h2 class="product-title"><?php echo $product['brand']; ?></h2>
                            <div class="ColorAndPrizeSize">
                                <div>
                                    <p class="product-size"><?php echo $product['sizeCollection']; ?></p>
                                    <p class="product-price">₹<?php echo $product['price']; ?></p>
                                </div>
                                <div>
                                    <div class="color-options">
                                        <span class="color-dot black"></span>
                                        <span class="color-dot blue"></span>
                                        <span class="color-dot gray"></span>
                                        <span class="color-dot more"><?php echo $product['discount']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <p class="offer">Get FREE BLU Screen Lenses</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="botton-page-button">
            <div class="pagination-container">
                <?php if ($page > 1): ?>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" class="pagination-button">Previous</a>
                <?php else: ?>
                    <button class="pagination-button" disabled>Previous</button>
                <?php endif; ?>

                <span class="page-number">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

                <?php if ($page < $totalPages): ?>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" class="pagination-button">Next</a>
                <?php else: ?>
                    <button class="pagination-button" disabled>Next</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>

    <script>
        let filterOpen = false;

        function toggleFilter() {
            const filterSection = document.getElementById('filterSection');
            const openBtn = document.getElementById('openFilter');
            const closeBtn = document.getElementById('closeFilter');

            filterOpen = !filterOpen;

            if (filterOpen) {
                filterSection.style.transform = 'translateX(0)';
                openBtn.style.display = 'none';
                closeBtn.style.display = 'block';
            } else {
                filterSection.style.transform = 'translateX(-400px)';
                openBtn.style.display = 'block';
                closeBtn.style.display = 'none';
            }
        }

        function setFrameFilter(frameType) {
            const form = document.getElementById('filterForm');
            const frameInput = document.querySelector('input[name="frame"][value="' + frameType + '"]');

            if (frameInput) {
                frameInput.checked = true;
            } else {
                // Create hidden input for frame types not in radio buttons
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'frame';
                hiddenInput.value = frameType;
                form.appendChild(hiddenInput);
            }

            form.submit();
        }

        function submitFilter() {
            document.getElementById('filterForm').submit();
        }

        // Initialize filter state on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 576) {
                document.getElementById('filterSection').style.transform = 'translateX(-400px)';
            }
        });
    </script>
</body>

</html>