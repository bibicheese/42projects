/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   test.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/04 13:57:17 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/04 23:17:56 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <unistd.h>

void	ft_putchar(char c);

void	ft_putnbr(int nb)
{
	unsigned int pos;

	if (nb < 0)
	{
		ft_putchar('-');
		pos = -nb;
	}
	pos = nb;
	if (pos > 9)
		ft_putnbr(pos / 10);
	ft_putchar(pos % 10 + '0');
}
