#ifndef BASE_CONF_H
#define BASE_CONF_H

/**
 * @file base_conf.h
 * @brief Файл базових налаштувань. Містить основні параматри налаштувань для роботи з кубиком. Вміщує список базових типів, корисних макросів для бінарних операцій, та швидке піднесення в цілий степінь. 
 * @version 0.01
 * @date 2022-03-20
 * 
 * @copyright Copyright (c) 2022
 * 
 */

/// Основні скорочення типів

/**
 * @brief тип uint це скорочення unsigned int
 * 
 */
typedef  unsigned int uint;

/**
 * @brief тип ushort це скорочення unsigned short
 * 
 */
typedef  unsigned short ushort;

/**
 * @brief тип uchar це скорочення unsigned char
 * 
 */
typedef  unsigned char uchar; 



/// Налаштування фізичних параметрів кубика


/**
 * @brief Максимально можлива ціла координата на кубику
 * 
 */ 
#define CUBE_MAX_COORD_INT 9

/**
 * @brief Кількість стрічок світлодіодів
 * 
 */
#define CUBE_STRIPS_COUNT 20

/**
 * @brief Кількість світлодіодів в стрічці
 * 
 */
#define CUBE_LED_COUNT_ON_STRIP 50

/**
 * @brief Масив номерів пінів до яких підключені світлодіодні стрічки
 * 
 */
extern const int CUBE_STRPIS_PINS[] = {00, 01, 02, 03, 04, 05, 06, 07, 08, 09, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19};



/// Налаштування render-а (відрисовника)




/**
 * @brief Налаштування для рендера час світіння однієї стрічки в мілісекундах (\f$10^{-3}\f$ секунди)
 * 
 */
#define RENDER_TIME_ON_STRIP 1



/// Налаштування веб-контролера




/**
 * @brief Затримка перед оновленням інформації з головного сервера
 * 
 */
#define WEBCTR_INF_UPDATE_DELAY 2000

/**
 * @brief Адреса запитів для кубика
 * 
 */
#define WEBCTR_QUERY_LINK "www.your-web.dom/for_cube_php"

/**
 * @brief SSID вашого WiFi пристрою
 * 
 */
#define WEBCTR_WIFI_SSID "your_ssid"

/**
 * @brief Пароль вашого WiFi прстрою
 * 
 */
#define WEBCTR_WIFI_PASS "your_password"



///Додаткові швидкі операції


/******* Корисні макроси *******/

/**
 * @brief Макрос знаходження найменшого значення
 * 
 */
#define MIN(a,b) (((a)<(b)) ? (a) : (b)) 

/**
 * @brief Макрос знаходження найбільшого значення
 * 
 */
#define MAX(a,b) (((a)>(b)) ? (a) : (b)) 

/**
 * @brief Макрос знаходження модуля числа
 * 
 */
#define ABS(a) ( (a)<0?(-(a)):(a) )

/**Базові бінарні операції над цілими числами**/

/**
 * @brief 32бітна одиниця 
 * 
 */
#define ONEUINT ((uint)1)


/**
 * @brief Повертає остачу від ділення a на 2
 * @param a число
 */
#define B_MOD(a) ((a) & ONEUINT ) //остача від ділення на 2
/**
 * @brief Цілочисельне множення числа a на \f$2^n \f$
 * @param a -- що помножити
 * @param n -- цілий додатний степінь 2
 */
#define B_MUL2n(a,n) ( (a) << ((uint)(n)) ) //множення на 2^n

/**
 * @brief Остача від ділення числа a на \f$2^n \f$
 * @param a -- що поділити
 * @param n -- цілий додатний степінь 2
 */
#define B_MOD2n(a,n) ( (a)& ( ~( ((uint)-1) << ((uint)(n)) ) ) )  //остача від ділення на 2^n


/**
 * @brief Цілочисельне ділення числа a на \f$2^n \f$
 * @param a -- що поділити
 * @param n -- цілий додатний степінь 2
 */
#define B_DIV2n(a,n) ( (a) >> ((uint)(n)) ) //цілочисельне ділення на 2^n


/**
 * @brief Надлишкове цілочисельне ділення числа a на \f$2^n \f$
 * @param a -- що поділити
 * @param n -- цілий додатний степінь 2
 */
#define B_OVER_DIV2n(a,n) ( B_DIV2n((a), ( (uint)(n) ) ) + ( B_MOD2n((a),((uint)(n)))? 1: 0 ) ) //надлишкове цілочисельне ділення на 2^n



#endif