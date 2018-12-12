/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_print_alphabet.c                                :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/02 10:02:46 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/02 14:27:44 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <unistd.h>

int		ft_putchar (char c);

void	ft_print_alphabet(void)
{
	int		letter;

	letter = 97;
	while (letter <= 122)
	{
		ft_putchar(letter);
		letter++;
	}
}
