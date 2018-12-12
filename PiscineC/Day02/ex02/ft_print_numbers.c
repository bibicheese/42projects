/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_print_numbers.c                                 :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/02 15:10:40 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/02 15:27:07 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <unistd.h>

int		ft_putchar (char c);

void	ft_print_numbers(void)
{
	int number;

	number = 48;
	while (number <= 57)
	{
		ft_putchar(number);
		number++;
	}
}
